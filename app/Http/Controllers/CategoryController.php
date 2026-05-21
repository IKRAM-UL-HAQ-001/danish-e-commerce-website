<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent')->orderBy('parent_id')->get();
        $allCategories = Category::all();
        return view('dashboard.categories.show', compact('categories', 'allCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $category = Category::where('slug', $request->slug)->firstOrFail();
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
            }
            $category->image = $request->file('image')->store('categories', 'public');
            $category->save();
        }

        $category->update([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('slug', $request->slug)->firstOrFail();
        
        // Delete image if exists
        if ($category->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
        }

        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
