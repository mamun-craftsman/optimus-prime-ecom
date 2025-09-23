<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'feedback' => 'required|string|max:500'
        ]);

        $product = Product::findOrFail($productId);
        $customerId = Auth::user()->customer->id;

        $existingReview = Review::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $request->rating,
                'feedback' => $request->feedback
            ]);
            return back()->with('success', 'Review updated successfully!');
        } else {
            Review::create([
                'customer_id' => $customerId,
                'product_id' => $productId,
                'rating' => $request->rating,
                'feedback' => $request->feedback
            ]);
            return back()->with('success', 'Review added successfully!');
        }
    }

    public function destroy($id)
    {
        $review = Review::where('id', $id)
            ->where('customer_id', Auth::user()->customer->id)
            ->firstOrFail();

        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }
}
