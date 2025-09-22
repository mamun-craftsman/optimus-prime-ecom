<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $subcategories = Subcategory::select('id', 'category_id', 'name', 'icon', 'slug')
            ->with(['category' => function ($query) {
                $query->select('id', 'name', 'slug');
            }])
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::select('id', 'name', 'slug', 'price', 'primary_image', 'stock', 'status', 'category_id', 'subcategory_id', 'key_feature_left')
            ->with([
                'category:id,name,slug',
                'subcategory:id,name,slug'
            ])
            ->where('status', 'sell')
            ->where('stock', '>', 0)
            ->orderBy('updated_at', 'desc')
            ->paginate(8);

        if ($request->ajax()) {
            $html = view('home.partials.product_cards', [
                'products' => $featuredProducts
            ])->render();

            return response()->json([
                'html' => $html,
                'hasMore' => $featuredProducts->hasMorePages(),
                'nextPage' => $featuredProducts->currentPage() + 1,
            ]);
        }

        return view('home.index', compact('subcategories', 'featuredProducts'));
    }
}
