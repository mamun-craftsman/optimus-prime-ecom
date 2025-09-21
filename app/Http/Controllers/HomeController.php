<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $subcategories = Subcategory::select('id', 'category_id', 'name', 'icon', 'slug')
        ->with(['category' => function ($query) {
            $query->select('id', 'name', 'slug');
        }])
        ->orderBy('name')
        ->get();

        $featured_products = Product::select('id', 'name', 'slug', 'price', 'primary_image', 'stock', 'status', 'category_id', 'subcategory_id')
            ->with([
                'category:id,name,slug',
                'subcategory:id,name,slug'
            ])
            ->where('status', 'sell')
            ->where('stock', '>', 0)
            ->orderBy('updated_at', 'desc')
            ->limit(8)
            ->get();

        return view('home.index', compact('subcategories', 'featured_products'));
    }
}
