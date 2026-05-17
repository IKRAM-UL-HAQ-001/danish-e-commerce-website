<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with('product')->get();
        $products = Product::where('status', 1)->get();
        return view('dashboard.offers.index', compact('offers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'nullable|exists:products,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'status' => 'required|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('offers', 'public');
        }

        Offer::create([
            'title' => $request->title,
            'product_id' => $request->product_id,
            'image' => $imagePath,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'status' => $request->status,
        ]);

        \App\Http\Controllers\ActivityController::log('Offer Created', "Added a new offer: {$request->title}");

        return back()->with('success', 'Offer created successfully.');
    }

    public function update(Request $request)
    {
        $offer = Offer::findOrFail($request->id);
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'nullable|exists:products,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($offer->image && Storage::disk('public')->exists($offer->image)) {
                Storage::disk('public')->delete($offer->image);
            }
            $offer->image = $request->file('image')->store('offers', 'public');
        }

        $offer->update([
            'title' => $request->title,
            'product_id' => $request->product_id,
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'status' => $request->status,
        ]);

        \App\Http\Controllers\ActivityController::log('Offer Updated', "Updated offer: {$request->title}");

        return back()->with('success', 'Offer updated successfully.');
    }

    public function destroy(Request $request)
    {
        $offer = Offer::findOrFail($request->id);
        if ($offer->image && Storage::disk('public')->exists($offer->image)) {
            Storage::disk('public')->delete($offer->image);
        }
        $offer->delete();

        \App\Http\Controllers\ActivityController::log('Offer Deleted', "Removed an offer.");

        return back()->with('success', 'Offer deleted successfully.');
    }
}
