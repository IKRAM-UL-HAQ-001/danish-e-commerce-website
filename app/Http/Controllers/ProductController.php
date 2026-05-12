<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        $categories = Category::all();
        $brands = Brand::where('status', 1)->get();
        return view('dashboard.products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
            'status' => 'required|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'sku' => $request->sku,
            'description' => $request->description,
            'tags' => $request->tags,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'status' => $request->status,
        ]);
        \App\Http\Controllers\ActivityController::log('Product Created', "Added a new product: {$request->name}");

        return back()->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $product = Product::where('slug', $request->slug)->firstOrFail();
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'sku' => $request->sku,
            'description' => $request->description,
            'tags' => $request->tags,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'status' => $request->status,
        ]);
        \App\Http\Controllers\ActivityController::log('Product Updated', "Modified product details for: {$request->name}");

        return back()->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::where('slug', $request->slug)->firstOrFail();
        if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}
