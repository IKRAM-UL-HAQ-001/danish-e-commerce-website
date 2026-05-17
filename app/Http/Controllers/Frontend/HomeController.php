<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Brand;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::whereNull('parent_id')->where('status', 1)->get();
        $products = Product::latest()->take(8)->get();
        
        // Fetch products for each category for the best selling section
        $categories_with_products = Category::whereNull('parent_id')
            ->where('status', 1)
            ->with(['products' => function($query) {
                $query->latest()->take(5);
            }])
            ->get();
            
        $all_best_selling = Product::latest()->take(5)->get();

        $settings = \DB::table('settings')->pluck('value', 'key');
        $activeOffer = \App\Models\Offer::where('status', 1)->with('product')->latest()->first();
        
        return view('frontend.index', compact(
            'sliders', 
            'categories', 
            'products', 
            'settings', 
            'categories_with_products', 
            'all_best_selling',
            'activeOffer'
        ));
    }

    public function about()
    {
        $about_content = Setting::where('key', 'about_us_content')->first();
        $about_image = Setting::where('key', 'about_us_image')->first();
        return view('frontend.about', compact('about_content', 'about_image'));
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

    public function shop(Request $request)
    {
        $query = Product::where('status', 1);
        $selectedCategory = null;
        $selectedBrand = null;

        // Get absolute min and max prices for the range slider
        $minPriceRange = floor(Product::min('price') ?? 0);
        $maxPriceRange = ceil(Product::max('price') ?? 1000);

        if ($request->has('category')) {
            $selectedCategory = Category::where('slug', $request->category)->first();
            if ($selectedCategory) {
                $categoryIds = $selectedCategory->subcategories()->pluck('id')->push($selectedCategory->id);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($request->has('brand')) {
            $selectedBrand = Brand::where('slug', $request->brand)->first();
            if ($selectedBrand) {
                $query->where('brand_id', $selectedBrand->id);
            }
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('status', 1)->whereNull('parent_id')->with(['subcategories' => function($q) {
            $q->where('status', 1);
        }])->get();
        $brands = Brand::all();
        
        return view('frontend.shop', compact('products', 'categories', 'brands', 'selectedCategory', 'selectedBrand', 'minPriceRange', 'maxPriceRange'));
    }
    public function offer(Request $request)
    {
        $offers = \App\Models\Offer::where('status', 1)->with('product')->latest()->get();
        return view('frontend.offer', compact('offers'));
    }

    public function offerDetails(\App\Models\Offer $offer)
    {
        $offer->load('product');
        return view('frontend.offer-details', compact('offer'));
    }

    public function shopList(Request $request)
    {
        $query = Product::where('status', 1);
        $selectedCategory = null;
        $selectedBrand = null;

        // Get absolute min and max prices for the range slider
        $minPriceRange = floor(Product::min('price') ?? 0);
        $maxPriceRange = ceil(Product::max('price') ?? 1000);

        if ($request->has('category')) {
            $selectedCategory = Category::where('slug', $request->category)->first();
            if ($selectedCategory) {
                $categoryIds = $selectedCategory->subcategories()->pluck('id')->push($selectedCategory->id);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($request->has('brand')) {
            $selectedBrand = Brand::where('slug', $request->brand)->first();
            if ($selectedBrand) {
                $query->where('brand_id', $selectedBrand->id);
            }
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(10)->withQueryString();
        $categories = Category::where('status', 1)->whereNull('parent_id')->with(['subcategories' => function($q) {
            $q->where('status', 1);
        }])->get();
        $brands = Brand::all();
        
        return view('frontend.shop-list', compact('products', 'categories', 'brands', 'selectedCategory', 'selectedBrand', 'minPriceRange', 'maxPriceRange'));
    }

    public function productDetails(Product $product)
    {
        $product->load(['reviews.user']);
        $product->loadCount('reviews');
        $featuredProducts = Product::where('status', 1)->where('id', '!=', $product->id)->latest()->take(6)->get();
        return view('frontend.product-details', compact('product', 'featuredProducts'));
    }

    public function cart()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('frontend.cart', compact('settings'));
    }

    public function checkout()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('frontend.checkout', compact('settings'));
    }
}
