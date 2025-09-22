<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Category;

class LayoutComposer
{
    public function compose(View $view): void
    {
        $categories = Category::select('id', 'name', 'icon', 'slug')
                              ->with(['subcategories' => function($query) {
                                  $query->select('id', 'category_id', 'name', 'icon', 'slug')
                                        ->orderBy('name');
                              }])
                              ->orderBy('name')
                              ->get();

        $subcategories = collect();
        foreach ($categories as $category) {
            $subcategories = $subcategories->merge($category->subcategories);
        }

        $view->with([
            'globalCategories' => $categories,
            'globalSubcategories' => $subcategories
        ]);
    }
}
