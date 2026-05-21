<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session('wishlist', []);
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function toggle(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);
        $wishlist = session('wishlist', []);

        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
            $added = false;
        } else {
            $wishlist[$productId] = [
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'slug'  => $product->slug,
            ];
            $added = true;
        }

        session(['wishlist' => $wishlist]);

        return response()->json([
            'success' => true,
            'added'   => $added,
            'count'   => count($wishlist),
            'message' => $added ? 'Added to wishlist.' : 'Removed from wishlist.',
        ]);
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $wishlist = session('wishlist', []);
        unset($wishlist[$productId]);
        session(['wishlist' => $wishlist]);

        return response()->json([
            'success' => true,
            'count'   => count($wishlist),
            'message' => 'Removed from wishlist.',
        ]);
    }
}
