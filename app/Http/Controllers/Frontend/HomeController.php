<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::all();
        $products = Product::latest()->take(8)->get();
        return view('frontend.index', compact('sliders', 'categories', 'products'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function terms()
    {
        $content = Setting::where('key', 'terms_content')->first();
        return view('pages.terms_view', compact('content'));
    }

    public function shop()
    {
        $products = Product::where('status', 1)->paginate(12);
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();
        return view('frontend.shop', compact('products', 'categories', 'brands'));
    }

    public function shopList()
    {
        $products = Product::where('status', 1)->paginate(10);
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();
        return view('frontend.shop-list', compact('products', 'categories', 'brands'));
    }

    public function productDetails(Product $product)
    {
        $featuredProducts = Product::where('status', 1)->where('id', '!=', $product->id)->latest()->take(6)->get();
        return view('frontend.product-details', compact('product', 'featuredProducts'));
    }
}
