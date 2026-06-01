<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Setting;
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
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $siteLogo = $settings['site_logo'] ?? null;
        return view('dashboard.products.index', compact('products', 'categories', 'brands', 'siteLogo'));
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
            'image_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_laptop' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'color_name' => 'nullable|string|max:100',
            'color_hex' => 'nullable|string|max:7',
            'status' => 'required|boolean',
        ]);


        $imageMobilePath = null;
        $imageLaptopPath = null;
        if ($request->hasFile('image_mobile')) {
            $imageMobilePath = $request->file('image_mobile')->store('products/mobile', 'public');
        }
        if ($request->hasFile('image_laptop')) {
            $imageLaptopPath = $request->file('image_laptop')->store('products/laptop', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'sku' => $request->sku,
            'description' => $request->description,
            'tags' => $request->tags,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_mobile' => $imageMobilePath,
            'image_laptop' => $imageLaptopPath,
            'color_name' => $request->color_name,
            'color_hex' => $request->color_hex,
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
            'image_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'image_laptop' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'color_name' => 'nullable|string|max:100',
            'color_hex' => 'nullable|string|max:7',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('image_mobile')) {
            if ($product->image_mobile && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image_mobile)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image_mobile);
            }
            $product->image_mobile = $request->file('image_mobile')->store('products/mobile', 'public');
        }

        if ($request->hasFile('image_laptop')) {
            if ($product->image_laptop && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image_laptop)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image_laptop);
            }
            $product->image_laptop = $request->file('image_laptop')->store('products/laptop', 'public');
        }

        // update color fields
        if ($request->filled('color_name') || $request->filled('color_hex')) {
            $product->color_name = $request->color_name;
            $product->color_hex = $request->color_hex;
        }

        $product->update([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'sku' => $request->sku,
            'description' => $request->description,
            'tags' => $request->tags,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_mobile' => $product->image_mobile,
            'image_laptop' => $product->image_laptop,
            'color_name' => $product->color_name,
            'color_hex' => $product->color_hex,
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
        if ($product->image_mobile && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image_mobile)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image_mobile);
        }
        if ($product->image_laptop && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image_laptop)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image_laptop);
        }
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}
