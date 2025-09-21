<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['subcategory.category', 'variations'])->paginate(10);
        $totalProducts = Product::count();
        $lowStock = Product::where('stock', '<', 10)->count();
        $outOfStock = Product::where('stock', 0)->count();
        $totalCategories = Category::count();

        return view('admin.products.index', compact('products', 'totalProducts', 'lowStock', 'outOfStock', 'totalCategories'));
    }

    public function fetch(Request $request)
    {
        $query = Product::with(['subcategory.category', 'variations']);

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('slug', 'like', '%' . $request->search . '%')
                ->orWhereHas('subcategory', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->subcategory_id) {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        $products = $query->paginate(10);

        if ($request->ajax()) {
            return view('admin.products._table', compact('products'));
        }

        return redirect()->route('admin.products.index');
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $attributes = Attribute::with('values')->orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'attributes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'key_feature_left' => 'required|string',
            'key_feature_right' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'primary_image' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'secondary_images.*' => 'image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:sell,sold',
            'has_variations' => 'boolean',
            'attributes' => 'array',
            'attributes.*' => 'exists:attributes,id',
            'attribute_values' => 'array',
            'variations' => 'array'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        DB::beginTransaction();

        try {
            $productData = [
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'category_id' => $validated['category_id'],
                'subcategory_id' => $validated['subcategory_id'],
                'key_feature_left' => $validated['key_feature_left'],
                'key_feature_right' => $validated['key_feature_right'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'video_url' => $validated['video_url'] ?? null,
                'stock' => $validated['stock'],
                'status' => $validated['status']
            ];

            if ($request->hasFile('primary_image')) {
                $productData['primary_image'] = $request->file('primary_image')->store('products', 'public');
            }

            $secondaryImages = [];
            if ($request->hasFile('secondary_images')) {
                foreach ($request->file('secondary_images') as $file) {
                    $secondaryImages[] = $file->store('products', 'public');
                }
                $productData['secondary_images'] = $secondaryImages;
            }

            $product = Product::create($productData);

            if ($request->has('has_variations') && $request->has('variations')) {
                $this->createProductVariations($product, $request->variations);
            }

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error creating product: ' . $e->getMessage())->withInput();
        }
    }


    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $subcategories = Subcategory::where('category_id', $product->category_id)->get();
        $attributes = Attribute::with('values')->orderBy('name')->get();
        $productVariations = $product->variations()->with('attributeValues.attribute')->get();

        return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'attributes', 'productVariations'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'key_feature_left' => 'required|string',
            'key_feature_right' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'primary_image' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'secondary_images.*' => 'image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:sell,sold', // Fixed: changed from active,inactive to sell,sold
            'has_variations' => 'nullable|boolean',
            'variations' => 'nullable|array'
        ]);

        DB::beginTransaction();

        try {
            $productData = [
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'subcategory_id' => $validated['subcategory_id'],
                'key_feature_left' => $validated['key_feature_left'],
                'key_feature_right' => $validated['key_feature_right'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'stock' => $validated['stock'],
                'status' => $validated['status']
            ];

            if (!empty($validated['slug'])) {
                $productData['slug'] = $validated['slug'];
            } else {
                $productData['slug'] = Str::slug($validated['name']);
            }

            if (isset($validated['video_url'])) {
                $productData['video_url'] = $validated['video_url'];
            }

            if ($request->hasFile('primary_image')) {
                if ($product->primary_image && Storage::disk('public')->exists($product->primary_image)) {
                    Storage::disk('public')->delete($product->primary_image);
                }
                $productData['primary_image'] = $request->file('primary_image')->store('products', 'public');
            }

            if ($request->hasFile('secondary_images')) {
                if ($product->secondary_images && is_array($product->secondary_images)) {
                    foreach ($product->secondary_images as $image) {
                        if (Storage::disk('public')->exists($image)) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }

                $secondaryImages = [];
                foreach ($request->file('secondary_images') as $file) {
                    $secondaryImages[] = $file->store('products', 'public');
                }
                $productData['secondary_images'] = $secondaryImages;
            }

            $product->update($productData);

            if ($request->has('has_variations') && $request->has('variations') && is_array($request->variations)) {
                $product->variations()->each(function ($variation) {
                    $variation->attributeValues()->detach();
                    $variation->delete();
                });

                $this->createProductVariations($product, $request->variations);
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product updated successfully',
                    'redirect' => route('admin.products.index')
                ]);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Product update error: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error updating product: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Error updating product: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Product $product, Request $request)
    {
        DB::beginTransaction();

        try {
            if ($product->primary_image && Storage::disk('public')->exists($product->primary_image)) {
                Storage::disk('public')->delete($product->primary_image);
            }

            if ($product->secondary_images) {
                foreach ($product->secondary_images as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $product->variations()->each(function ($variation) {
                $variation->attributeValues()->detach();
                $variation->delete();
            });

            $product->delete();

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error deleting product']);
            }

            return redirect()->back()->with('error', 'Error deleting product');
        }
    }

    public function fetchSubcategories($categoryId)
    {
        try {
            $subcategories = Subcategory::where('category_id', $categoryId)
                ->select('id', 'name')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'subcategories' => $subcategories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching subcategories: ' . $e->getMessage()
            ], 500);
        }
    }


    public function generateVariations(Request $request)
    {
        $validated = $request->validate([
            'attributes' => 'required|array|min:1',
            'attributes.*.id' => 'required|integer|exists:attributes,id',
            'attributes.*.values' => 'required|array|min:1',
            'attributes.*.values.*' => 'required|integer|exists:attribute_values,id',
            'base_price' => 'required|numeric|min:0',
            'base_stock' => 'required|integer|min:0'
        ]);

        try {
            $attributeValues = [];

            foreach ($validated['attributes'] as $attr) {
                $values = AttributeValue::whereIn('id', $attr['values'])
                    ->with('attribute')
                    ->get()
                    ->toArray();
                $attributeValues[] = $values;
            }

            $combinations = $this->cartesianProduct($attributeValues);
            $variations = [];

            foreach ($combinations as $combination) {
                $name = '';
                $valueIds = [];

                foreach ($combination as $value) {
                    $name .= $value['attribute']['name'] . ': ' . $value['value'] . ' ';
                    $valueIds[] = $value['id'];
                }

                $variations[] = [
                    'name' => trim($name),
                    'price' => $validated['base_price'],
                    'stock' => $validated['base_stock'],
                    'status' => 'sell',
                    'attribute_value_ids' => $valueIds
                ];
            }

            return response()->json([
                'success' => true,
                'variations' => $variations,
                'total' => count($variations)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating variations: ' . $e->getMessage()
            ], 500);
        }
    }

    private function cartesianProduct($arrays)
    {
        $result = [[]];

        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property_value]);
                }
            }
            $result = $tmp;
        }

        return $result;
    }




    private function createProductVariations($product, $variations)
    {
        foreach ($variations as $variationData) {
            $variation = ProductVariation::create([
                'product_id' => $product->id,
                'name' => $variationData['name'],
                'price' => $variationData['price'],
                'stock' => $variationData['stock'],
                'status' => $variationData['status'] ?? 'sell'
            ]);

            if (isset($variationData['attribute_value_ids'])) {
                $attributeValueIds = is_string($variationData['attribute_value_ids'])
                    ? json_decode($variationData['attribute_value_ids'], true)
                    : $variationData['attribute_value_ids'];

                $variation->attributeValues()->sync($attributeValueIds);
            }
        }
    }

    public function getAttributes(Request $request)
    {
        if ($request->ajax()) {
            $attributes = Attribute::with('values')->orderBy('name')->get();

            return response()->json([
                'success' => true,
                'attributes' => $attributes
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }

    public function getAttributeValues(Request $request, Attribute $attribute)
    {
        if ($request->ajax()) {
            $values = $attribute->values()->orderBy('value')->get();

            return response()->json([
                'success' => true,
                'values' => $values
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }
}
