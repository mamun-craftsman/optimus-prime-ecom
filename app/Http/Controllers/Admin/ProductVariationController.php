<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVariationController extends Controller
{
    public function attributeIndex()
    {
        $attributes = Attribute::with('values')->paginate(10);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function attributeFetch(Request $request)
    {
        $query = Attribute::with('values');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $attributes = $query->paginate(10);

        if ($request->ajax()) {
            return view('admin.attributes._table', compact('attributes'));
        }

        return redirect()->route('admin.attributes.index');
    }

    public function attributeStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:attributes',
            'values' => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $attribute = Attribute::create(['name' => $validated['name']]);

            $values = json_decode($validated['values'], true);
            if ($values) {
                foreach ($values as $value) {
                    if (!empty($value)) {
                        $attribute->values()->create(['value' => $value]);
                    }
                }
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Attribute created successfully']);
            }

            return redirect()->route('admin.attributes.index')->with('success', 'Attribute created successfully');
        } catch (\Exception $e) {
            DB::rollback();

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error creating attribute']);
            }

            return redirect()->back()->with('error', 'Error creating attribute');
        }
    }

    public function attributeUpdate(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:attributes,name,' . $attribute->id,
            'values' => 'required|string'
        ]);

        DB::beginTransaction();

        try {
            $attribute->update(['name' => $validated['name']]);

            $attribute->values()->delete();

            $values = json_decode($validated['values'], true);
            if ($values) {
                foreach ($values as $value) {
                    if (!empty($value)) {
                        $attribute->values()->create(['value' => $value]);
                    }
                }
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Attribute updated successfully']);
            }

            return redirect()->route('admin.attributes.index')->with('success', 'Attribute updated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error updating attribute']);
            }

            return redirect()->back()->with('error', 'Error updating attribute');
        }
    }


    public function attributeDestroy(Attribute $attribute, Request $request)
    {
        DB::beginTransaction();

        try {
            $attribute->values()->delete();
            $attribute->delete();

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Attribute deleted successfully']);
            }

            return redirect()->route('admin.attributes.index')->with('success', 'Attribute deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error deleting attribute']);
            }

            return redirect()->route('admin.attributes.index')->with('error', 'Error deleting attribute');
        }
    }

    public function valueStore(Request $request)
    {
        $validated = $request->validate([
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string|max:255'
        ]);

        $value = AttributeValue::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Attribute value created successfully',
                'value' => $value
            ]);
        }

        return redirect()->back()->with('success', 'Attribute value created successfully');
    }

    public function valueUpdate(Request $request, AttributeValue $value)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255'
        ]);

        $value->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Attribute value updated successfully']);
        }

        return redirect()->back()->with('success', 'Attribute value updated successfully');
    }

    public function valueDestroy(AttributeValue $value, Request $request)
    {
        $value->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Attribute value deleted successfully']);
        }

        return redirect()->back()->with('success', 'Attribute value deleted successfully');
    }


    public function getAttributeValues(Request $request, Attribute $attribute)
    {
        if ($request->ajax()) {
            $values = $attribute->values()->get();

            return response()->json([
                'success' => true,
                'values' => $values
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }

    public function bulkVariationGenerate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'base_price' => 'required|numeric|min:0',
            'base_name' => 'required|string|max:255',
            'attribute_combinations' => 'required|array',
            'attribute_combinations.*.attribute_values' => 'required|array',
            'attribute_combinations.*.price_modifier' => 'nullable|numeric',
            'attribute_combinations.*.stock' => 'required|integer|min:0'
        ]);

        DB::beginTransaction();

        try {
            foreach ($validated['attribute_combinations'] as $index => $combination) {
                $price = $validated['base_price'] + ($combination['price_modifier'] ?? 0);
                $name = $validated['base_name'] . ' - Variation ' . ($index + 1);

                $variation = ProductVariation::create([
                    'product_id' => $product->id,
                    'name' => $name,
                    'price' => $price,
                    'stock' => $combination['stock'],
                    'status' => 'sell'
                ]);

                $variation->attributeValues()->sync($combination['attribute_values']);
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Product variations generated successfully']);
            }

            return redirect()->route('admin.variations.index', $product)->with('success', 'Product variations generated successfully');
        } catch (\Exception $e) {
            DB::rollback();

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error generating variations']);
            }

            return redirect()->back()->with('error', 'Error generating variations');
        }
    }
    public function variationUpdate(Request $request, Product $product, ProductVariation $variation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:sell,sold'
        ]);

        try {
            $variation->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Variation updated successfully',
                'variation' => $variation
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating variation: ' . $e->getMessage()
            ], 500);
        }
    }

    public function variationDestroy(Request $request, Product $product, ProductVariation $variation)
    {
        try {
            DB::beginTransaction();

            $variation->attributeValues()->detach();
            $variation->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Variation deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error deleting variation: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdateVariations(Request $request, Product $product)
    {
        $validated = $request->validate([
            'variations' => 'required|array',
            'variations.*.id' => 'required|integer',
            'variations.*.name' => 'required|string|max:255',
            'variations.*.price' => 'required|numeric|min:0',
            'variations.*.stock' => 'required|integer|min:0',
            'variations.*.status' => 'required|in:sell,sold'
        ]);

        try {
            DB::beginTransaction();

            foreach ($validated['variations'] as $variationData) {
                $variation = ProductVariation::where('id', $variationData['id'])
                    ->where('product_id', $product->id)
                    ->first();

                if (!$variation) {
                    throw new \Exception("Variation with ID {$variationData['id']} not found for this product");
                }

                $variation->update([
                    'name' => $variationData['name'],
                    'price' => $variationData['price'],
                    'stock' => $variationData['stock'],
                    'status' => $variationData['status']
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'All variations updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error updating variations: ' . $e->getMessage()
            ], 500);
        }
    }


    public function variationIndex(Product $product)
    {
        $variations = $product->variations()
            ->with('attributeValues.attribute')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.variations.index', compact('product', 'variations'));
    }

    public function variationShow(Product $product, ProductVariation $variation)
    {
        $variation->load('attributeValues.attribute');

        return response()->json([
            'success' => true,
            'variation' => $variation
        ]);
    }

    public function variationStore(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:sell,sold',
            'attribute_value_ids' => 'array',
            'attribute_value_ids.*' => 'exists:attribute_values,id'
        ]);

        try {
            DB::beginTransaction();

            $variation = ProductVariation::create([
                'product_id' => $product->id,
                'name' => $validated['name'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'status' => $validated['status']
            ]);

            if (isset($validated['attribute_value_ids']) && !empty($validated['attribute_value_ids'])) {
                $variation->attributeValues()->sync($validated['attribute_value_ids']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Variation created successfully',
                'variation' => $variation->load('attributeValues.attribute')
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error creating variation: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleVariationStatus(Request $request, Product $product, ProductVariation $variation)
    {
        try {
            $newStatus = $variation->status === 'sell' ? 'sold' : 'sell';
            $variation->update(['status' => $newStatus]);

            return response()->json([
                'success' => true,
                'message' => 'Variation status updated successfully',
                'status' => $newStatus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating variation status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function duplicateVariation(Request $request, Product $product, ProductVariation $variation)
    {
        try {
            DB::beginTransaction();

            $newVariation = ProductVariation::create([
                'product_id' => $product->id,
                'name' => $variation->name . ' (Copy)',
                'price' => $variation->price,
                'stock' => 0,
                'status' => 'sell'
            ]);

            $variation->attributeValues->each(function ($attributeValue) use ($newVariation) {
                $newVariation->attributeValues()->attach($attributeValue->id);
            });

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Variation duplicated successfully',
                'variation' => $newVariation->load('attributeValues.attribute')
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error duplicating variation: ' . $e->getMessage()
            ], 500);
        }
    }

    public function variationFetch(Request $request, Product $product)
    {
        $query = $product->variations()->with('attributeValues.attribute');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        $variations = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.variations._table', compact('variations', 'product'));
        }

        return redirect()->route('admin.variations.index', $product);
    }

    public function updateVariationStock(Request $request, Product $product, ProductVariation $variation)
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
            'operation' => 'required|in:set,add,subtract'
        ]);

        try {
            switch ($validated['operation']) {
                case 'set':
                    $variation->update(['stock' => $validated['stock']]);
                    break;
                case 'add':
                    $variation->increment('stock', $validated['stock']);
                    break;
                case 'subtract':
                    $variation->decrement('stock', $validated['stock']);
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => 'Stock updated successfully',
                'new_stock' => $variation->fresh()->stock
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating stock: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getVariationAnalytics(Product $product)
    {
        try {
            $analytics = [
                'total_variations' => $product->variations()->count(),
                'active_variations' => $product->variations()->where('status', 'sell')->count(),
                'sold_variations' => $product->variations()->where('status', 'sold')->count(),
                'total_stock' => $product->variations()->sum('stock'),
                'out_of_stock' => $product->variations()->where('stock', 0)->count(),
                'low_stock' => $product->variations()->where('stock', '>', 0)->where('stock', '<', 10)->count(),
                'average_price' => $product->variations()->avg('price'),
                'highest_price' => $product->variations()->max('price'),
                'lowest_price' => $product->variations()->min('price'),
                'total_value' => $product->variations()->selectRaw('SUM(price * stock) as total')->value('total')
            ];

            return response()->json([
                'success' => true,
                'analytics' => $analytics
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching analytics: ' . $e->getMessage()
            ], 500);
        }
    }
}
