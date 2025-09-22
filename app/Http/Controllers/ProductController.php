<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            'variations' => function($query) {
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

}
