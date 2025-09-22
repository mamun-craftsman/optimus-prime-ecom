<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('customer_id', $this->getCustomerId())
            ->with([
                'product:id,name,slug,price,primary_image,stock,status',
                'variations.attributeValues.attribute'
            ])
            ->get();

        $total = $cartItems->sum(function ($item) {
            $basePrice = $item->variations->isNotEmpty() 
                ? $item->variations->sum('price') 
                : $item->product->price;
            return $basePrice * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variations' => 'sometimes|array',
            'variations.*' => 'exists:product_variations,id'
        ]);

        $customerId = $this->getCustomerId();
        
        if (!$customerId) {
            return response()->json([
                'success' => false,
                'message' => 'Customer profile not found. Please complete your profile first.'
            ], 400);
        }

        $product = Product::findOrFail($request->product_id);
        
        if ($product->status !== 'sell' || $product->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Product not available or insufficient stock'
            ], 400);
        }

        try {
            DB::transaction(function () use ($request, $product, $customerId) {
                $variations = $request->variations ?? [];
                
                $existingCart = null;
                
                if (empty($variations)) {
                    $existingCart = Cart::where('customer_id', $customerId)
                        ->where('product_id', $request->product_id)
                        ->whereDoesntHave('variations')
                        ->first();
                } else {
                    $existingCart = Cart::where('customer_id', $customerId)
                        ->where('product_id', $request->product_id)
                        ->whereHas('variations', function($query) use ($variations) {
                            $query->whereIn('product_variation_id', $variations);
                        }, '=', count($variations))
                        ->first();
                    
                    if ($existingCart) {
                        $existingVariationIds = $existingCart->variations->pluck('id')->sort()->values()->toArray();
                        $newVariationIds = collect($variations)->sort()->values()->toArray();
                        
                        if ($existingVariationIds !== $newVariationIds) {
                            $existingCart = null;
                        }
                    }
                }

                if ($existingCart) {
                    $newQuantity = $existingCart->quantity + $request->quantity;
                    if ($newQuantity > $product->stock) {
                        throw new \Exception('Insufficient stock');
                    }
                    $existingCart->update(['quantity' => $newQuantity]);
                    $cart = $existingCart;
                } else {
                    $cart = Cart::create([
                        'customer_id' => $customerId,
                        'product_id' => $request->product_id,
                        'quantity' => $request->quantity
                    ]);
                    
                    if (!empty($variations)) {
                        $cart->variations()->attach($variations);
                    }
                }
            });
            Log::info('Cart add request:', [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'variations' => $request->variations ?? []
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'cart_count' => $this->getCartCount()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('customer_id', $this->getCustomerId())
            ->where('id', $id)
            ->with('product')
            ->firstOrFail();

        if ($request->quantity > $cartItem->product->stock) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock'
            ], 400);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        $newTotal = $this->calculateItemTotal($cartItem);
        $cartTotal = $this->calculateCartTotal();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
            'item_total' => number_format($newTotal, 2),
            'cart_total' => number_format($cartTotal, 2),
            'cart_count' => $this->getCartCount()
        ]);
    }

    public function updateVariation(Request $request, $id)
    {
        $request->validate([
            'variation_id' => 'required|exists:product_variations,id'
        ]);

        $cartItem = Cart::where('customer_id', $this->getCustomerId())
            ->where('id', $id)
            ->firstOrFail();

        $cartItem->variations()->sync([$request->variation_id]);

        return response()->json([
            'success' => true,
            'message' => 'Variation updated successfully'
        ]);
    }

    public function remove($id)
    {
        $cartItem = Cart::where('customer_id', $this->getCustomerId())
            ->where('id', $id)
            ->firstOrFail();

        $cartItem->variations()->detach();
        $cartItem->delete();

        $cartTotal = $this->calculateCartTotal();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_total' => number_format($cartTotal, 2),
            'cart_count' => $this->getCartCount()
        ]);
    }

    public function clear()
    {
        $cartItems = Cart::where('customer_id', $this->getCustomerId())->get();
        
        foreach ($cartItems as $item) {
            $item->variations()->detach();
            $item->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully',
            'cart_count' => 0
        ]);
    }

    public function count()
    {
        return response()->json([
            'count' => $this->getCartCount()
        ]);
    }

    private function getCartCount()
    {
        return Cart::where('customer_id', $this->getCustomerId())->sum('quantity');
    }

    private function calculateItemTotal($cartItem)
    {
        $basePrice = $cartItem->variations->isNotEmpty() 
            ? $cartItem->variations->sum('price') 
            : $cartItem->product->price;
        return $basePrice * $cartItem->quantity;
    }

    private function calculateCartTotal()
    {
        $cartItems = Cart::where('customer_id', $this->getCustomerId())
            ->with(['product', 'variations'])
            ->get();

        return $cartItems->sum(function ($item) {
            return $this->calculateItemTotal($item);
        });
    }
     private function getCustomerId()
    {
        $user = Auth::user();
        return $user->customer ? $user->customer->id : null;
    }
}
