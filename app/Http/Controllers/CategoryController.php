<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('listings')->paginate(15);
        return view('dashboard.admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        Category::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully'
        ]);
    }

    public function edit(Category $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        $category->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully'
        ]);
    }

    public function destroy(Category $category)
    {
        if ($category->listings()->exists()) {
            return back()->with('error', 'Cannot delete category with existing listings');
        }

        $category->delete();
        return back()->with('success', 'Category deleted successfully');
    }
}