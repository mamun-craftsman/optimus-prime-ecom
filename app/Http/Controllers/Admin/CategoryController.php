<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function fetch(Request $request)
    {
        $query = Category::query();
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
        }
        
        $categories = $query->paginate(10);
        
        if ($request->ajax()) {
            return view('admin.categories._table', compact('categories'));
        }
        
        return redirect()->route('admin.categories.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('categories', 'public');
            $validated['icon'] = $iconPath;
        }
        
        Category::create($validated);
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category created successfully']);
        }
        
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if ($request->hasFile('icon')) {
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
            
            $iconPath = $request->file('icon')->store('categories', 'public');
            $validated['icon'] = $iconPath;
        }
        
        $category->update($validated);
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category updated successfully']);
        }
        
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category, Request $request)
    {
        if ($category->icon && Storage::disk('public')->exists($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }
        
        $category->delete();
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category deleted successfully']);
        }
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
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
