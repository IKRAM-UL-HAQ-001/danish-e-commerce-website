<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $request->quantity ?? 1,
                "price" => $product->price,
                "image" => $product->image,
                "sku" => $product->sku
            ];
        }

        session()->put('cart', $cart);
        
        $cartCount = count($cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully!',
            'cartCount' => $cartCount
        ]);
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['status' => 'success', 'message' => 'Cart updated successfully']);
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return response()->json(['status' => 'success', 'message' => 'Product removed successfully']);
        }
    }
}
