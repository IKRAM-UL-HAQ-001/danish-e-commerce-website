<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('dashboard.sliders.index', compact('sliders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:15360',
            'status' => 'required|boolean',
        ]);

        $imagePath = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Slider created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15360',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($slider->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($slider->image);
            }
            $slider->image = $request->file('image')->store('sliders', 'public');
        }

        $slider->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if ($slider->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($slider->image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();
        return back()->with('success', 'Slider deleted successfully.');
    }
}
