<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->orWhere('id', $slug)
            ->with([
                'category:id,name,slug',
                'subcategory:id,name,slug',
                'variations' => function ($query) {
                    $query->where('status', 'sell')
                        ->with(['attributeValues.attribute']);
                }
            ])
            ->firstOrFail();

        if ($product->status !== 'sell') {
            abort(404, 'Product not available');
        }

        $groupedAttributes = collect();
        $variationMap = [];

        if ($product->variations->isNotEmpty()) {
            foreach ($product->variations as $variation) {
                $attributes = [];

                foreach ($variation->attributeValues as $attributeValue) {
                    $attributeName = $attributeValue->attribute->name;
                    $attributes[$attributeName] = $attributeValue->value;

                    if (!$groupedAttributes->has($attributeName)) {
                        $groupedAttributes[$attributeName] = collect();
                    }

                    if (!$groupedAttributes[$attributeName]->contains('value', $attributeValue->value)) {
                        $groupedAttributes[$attributeName]->push($attributeValue);
                    }
                }

                ksort($attributes);
                $signature = json_encode($attributes);
                $variationMap[$signature] = $variation->id;
            }
        }

        return view('home.products.show', compact('product', 'groupedAttributes', 'variationMap'));
    }
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->take(8)
            ->get(['id', 'name', 'primary_image', 'price', 'slug']);

        return response()->json($products);
    }

    public function category(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = Product::where('category_id', $category->id)
            ->with(['reviews', 'category']);

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderByRaw('CAST(price AS DECIMAL(10,2)) ASC');
                    break;
                case 'price_high':
                    $query->orderByRaw('CAST(price AS DECIMAL(10,2)) DESC');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'rating':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();

        return view('home.products.cat', compact('category', 'products'));
    }

    public function subcategory(Request $request, $categorySlug, $subcategorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $subcategory = Subcategory::where('slug', $subcategorySlug)
            ->where('category_id', $category->id)
            ->firstOrFail();

        $query = Product::where('subcategory_id', $subcategory->id)
            ->with(['reviews', 'category', 'subcategory']);

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderByRaw('CAST(price AS DECIMAL(10,2)) ASC');
                    break;
                case 'price_high':
                    $query->orderByRaw('CAST(price AS DECIMAL(10,2)) DESC');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'rating':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();

        return view('home.products.subcat', compact('category', 'subcategory', 'products'));
    }
}
