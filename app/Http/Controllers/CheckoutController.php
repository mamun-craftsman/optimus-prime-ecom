<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ShurjopayPlugin\Shurjopay;
use ShurjopayPlugin\ShurjopayConfig;
use ShurjopayPlugin\PaymentRequest;

class CheckoutController extends Controller
{
    private $shurjopay;

    public function __construct()
    {
        $config = new ShurjopayConfig();
        $config->username = env('SP_USERNAME', 'sp_sandbox');
        $config->password = env('SP_PASSWORD', 'pyyk97hu&6u6');
        $config->order_prefix = env('SP_PREFIX', 'NOK');
        $config->api_endpoint = env('SHURJOPAY_API', 'https://sandbox.shurjopayment.com');
        $config->callback_url = url('/checkout/callback');
        $config->log_path = storage_path('logs');
        $config->ssl_verifypeer = 1;

        $this->shurjopay = new Shurjopay($config);
    }

    private function getCustomerId()
    {
        return Auth::user()->customer->id ?? null;
    }

    public function index()
    {
        $cartItems = Cart::with(['product', 'variations'])->where('customer_id', $this->getCustomerId())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $user = Auth::user();
        $shippingAddress = $user->customer->shipping_addr ?? '';
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $shipping = $subtotal > 50 ? 0 : 10;
        $tax = $subtotal * 0.10;
        $total = $subtotal + $shipping + $tax;

        return view('home.checkout.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total', 'user', 'shippingAddress'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'payment_method' => 'required|in:surjopay,cash_on_delivery'
        ]);

        if ($request->has('save_shipping_address') && Auth::user()->customer) {
            Auth::user()->customer->update(['shipping_addr' => $request->address]);
        }

        $cartItems = Cart::with(['product', 'variations'])->where('customer_id', $this->getCustomerId())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $total = $subtotal + ($subtotal > 50 ? 0 : 10) + ($subtotal * 0.10);

        if ($request->payment_method === 'cash_on_delivery') {
            return $this->processCashOnDelivery($request, $cartItems, $total);
        }

        $user = Auth::user();
        $tempOrderId = 'TEMP_' . time() . '_' . Auth::id();
        
        DB::table('temp_orders')->insert([
            'order_id' => $tempOrderId,
            'user_id' => Auth::id(),
            'customer_id' => $this->getCustomerId(),
            'address' => $request->address,
            'cart_data' => json_encode($cartItems->toArray()),
            'total' => $total,
            'created_at' => now()
        ]);

        $paymentRequest = new PaymentRequest();
        $paymentRequest->currency = 'BDT';
        $paymentRequest->amount = $total;
        $paymentRequest->discountAmount = 0;
        $paymentRequest->discPercent = 0;
        $paymentRequest->customerName = $user->name;
        $paymentRequest->customerPhone = $user->phone;
        $paymentRequest->customerEmail = $user->email;
        $paymentRequest->customerAddress = $request->address;
        $paymentRequest->customerCity = 'Dhaka';
        $paymentRequest->customerState = 'Dhaka';
        $paymentRequest->customerPostcode = '1000';
        $paymentRequest->customerCountry = 'Bangladesh';
        $paymentRequest->shippingAddress = $request->address;
        $paymentRequest->shippingCity = 'Dhaka';
        $paymentRequest->shippingCountry = 'Bangladesh';
        $paymentRequest->receivedPersonName = $user->name;
        $paymentRequest->shippingPhoneNumber = $user->phone;
        $paymentRequest->value1 = $tempOrderId;
        $paymentRequest->value2 = Auth::id();
        $paymentRequest->value3 = $this->getCustomerId();
        $paymentRequest->value4 = $request->address;

        $this->shurjopay->makePayment($paymentRequest);
    }

public function callback(Request $request)
{
    Log::info('=== CALLBACK START ===');
    Log::info('Full request data', $request->all());
    
    $spOrderId = $request->input('order_id');
    
    Log::info('SP Order ID from request', ['sp_order_id' => $spOrderId]);
    
    if (!$spOrderId) {
        Log::error('No SP Order ID found');
        return redirect()->route('checkout.cancel');
    }

    try {
        Log::info('Starting payment verification for: ' . $spOrderId);
        $verification = $this->shurjopay->verifyPayment($spOrderId);
        Log::info('Verification response', ['verification' => $verification]);
        
        if ($verification && isset($verification[0]) && $verification[0]->sp_code == 1000) {
            $payment = $verification[0];
            Log::info('Payment verified successfully', ['payment_data' => $payment]);
            
            // Get temp order ID from payment verification data
            $tempOrderId = $payment->value1;
            $userId = $payment->value2;
            $customerId = $payment->value3;
            $address = $payment->value4;
            
            Log::info('Data from payment verification', [
                'temp_order_id' => $tempOrderId,
                'user_id' => $userId,
                'customer_id' => $customerId,
                'address' => $address
            ]);
            
            // Check if order already exists
            $existingOrder = Order::where('order_number', $spOrderId)->first();
            Log::info('Existing order check', ['exists' => $existingOrder ? 'YES' : 'NO']);
            
            if (!$existingOrder) {
                // Try to find temp order
                $tempOrder = DB::table('temp_orders')->where('order_id', $tempOrderId)->first();
                Log::info('Temp order search', [
                    'searching_for' => $tempOrderId,
                    'found' => $tempOrder ? 'YES' : 'NO',
                    'temp_order_data' => $tempOrder
                ]);
                
                if ($tempOrder) {
                    Log::info('Starting order creation with temp order data');
                    
                    try {
                        DB::beginTransaction();
                        
                        $order = Order::create([
                            'user_id' => $tempOrder->user_id,
                            'order_number' => $spOrderId,
                            'full_name' => $payment->name,
                            'email' => $payment->email,
                            'phone' => $payment->phone_no,
                            'address' => $tempOrder->address,
                            'subtotal' => $payment->amount - 10 - ($payment->amount * 0.10),
                            'shipping' => 10,
                            'tax' => $payment->amount * 0.10,
                            'total' => $payment->amount,
                            'payment_method' => 'surjopay',
                            'payment_status' => 'paid',
                            'order_status' => 'processing',
                            'transaction_id' => $payment->bank_trx_id
                        ]);
                        
                        Log::info('Order created successfully', ['order_id' => $order->id, 'order_number' => $order->order_number]);
                        
                        $cartItems = json_decode($tempOrder->cart_data, true);
                        Log::info('Cart items from temp order', ['items_count' => count($cartItems)]);
                        
                        foreach ($cartItems as $index => $cartItem) {
                            Log::info('Creating order item ' . ($index + 1), ['product_id' => $cartItem['product_id']]);
                            
                            $orderItem = OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $cartItem['product_id'],
                                'quantity' => $cartItem['quantity'],
                                'price' => $cartItem['product']['price'],
                                'variations' => json_encode(collect($cartItem['variations'])->pluck('id')->toArray())
                            ]);
                            
                            Log::info('Order item created', ['item_id' => $orderItem->id]);
                        }
                        
                        // Clear cart and temp order
                        $cartDeleted = Cart::where('customer_id', $tempOrder->customer_id)->delete();
                        $tempDeleted = DB::table('temp_orders')->where('order_id', $tempOrderId)->delete();
                        
                        Log::info('Cleanup completed', [
                            'cart_items_deleted' => $cartDeleted,
                            'temp_orders_deleted' => $tempDeleted
                        ]);
                        
                        DB::commit();
                        Log::info('Transaction committed successfully');
                        
                        return redirect()->route('checkout.success');
                        
                    } catch (\Exception $e) {
                        DB::rollback();
                        Log::error('Order creation failed', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        return redirect()->route('checkout.cancel');
                    }
                } else {
                    Log::error('No temp order found for temp_order_id: ' . $tempOrderId);
                    return redirect()->route('checkout.cancel');
                }
            } else {
                Log::info('Order already exists, redirecting to success');
                return redirect()->route('checkout.success');
            }
        } else {
            Log::error('Payment verification failed', ['verification' => $verification]);
            return redirect()->route('checkout.cancel');
        }
    } catch (\Exception $e) {
        Log::error('Callback exception', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->route('checkout.cancel');
    }
}



    public function processCashOnDelivery(Request $request, $cartItems, $total)
    {
        DB::transaction(function () use ($request, $cartItems, $total) {
            $user = Auth::user();
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORDER_' . time(),
                'full_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $request->address,
                'subtotal' => $total - 10 - ($total * 0.10),
                'shipping' => 10,
                'tax' => $total * 0.10,
                'total' => $total,
                'payment_method' => 'cash_on_delivery',
                'payment_status' => 'pending',
                'order_status' => 'pending'
            ]);

            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    'variations' => json_encode($cartItem->variations->pluck('id')->toArray())
                ]);
            }

            Cart::where('customer_id', $this->getCustomerId())->delete();
        });
        
        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('home.checkout.success');
    }

    public function cancel()
    {
        return view('home.checkout.cancel');
    }
}
