<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->paginate(10);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function fetch(Request $request)
    {
        $query = Subcategory::with('category');
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%')
                  ->orWhereHas('category', function($q) use ($request) {
                      $q->where('name', 'like', '%' . $request->search . '%');
                  });
        }
        
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        $subcategories = $query->paginate(10);
        
        if ($request->ajax()) {
            return view('admin.subcategories._table', compact('subcategories'));
        }
        
        return redirect()->route('admin.subcategories.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:subcategories',
            'category_id' => 'required|exists:categories,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('subcategories', 'public');
            $validated['icon'] = $iconPath;
        }
        
        Subcategory::create($validated);
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Subcategory created successfully']);
        }
        
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory created successfully');
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:subcategories,slug,' . $subcategory->id,
            'category_id' => 'required|exists:categories,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if ($request->hasFile('icon')) {
            if ($subcategory->icon && Storage::disk('public')->exists($subcategory->icon)) {
                Storage::disk('public')->delete($subcategory->icon);
            }
            
            $iconPath = $request->file('icon')->store('subcategories', 'public');
            $validated['icon'] = $iconPath;
        }
        
        $subcategory->update($validated);
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Subcategory updated successfully']);
        }
        
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully');
    }

    public function destroy(Subcategory $subcategory, Request $request)
    {
        if ($subcategory->icon && Storage::disk('public')->exists($subcategory->icon)) {
            Storage::disk('public')->delete($subcategory->icon);
        }
        
        $subcategory->delete();
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Subcategory deleted successfully']);
        }
        
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory deleted successfully');
    }

    public function fetchCategories(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::select('id', 'name')
                                ->orderBy('name')
                                ->get();
            
            return response()->json([
                'success' => true,
                'categories' => $categories
            ]);
        }
        
        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }
}
