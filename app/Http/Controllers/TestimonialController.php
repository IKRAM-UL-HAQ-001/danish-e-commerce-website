<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    // Admin: List testimonials
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('dashboard.testimonials.index', compact('testimonials'));
    }

    // Admin: Show create form
    public function create()
    {
        return view('dashboard.testimonials.create');
    }

    // Admin: Store testimonial
    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
        }
        Testimonial::create([
            'author' => $request->author,
            'designation' => $request->designation,
            'text' => $request->text,
            'image' => $imagePath,
        ]);
        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    // Admin: Show edit form
    public function edit(Testimonial $testimonial)
    {
        return view('dashboard.testimonials.edit', compact('testimonial'));
    }

    // Admin: Update testimonial
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);
        if ($request->hasFile('image')) {
            if ($testimonial->image && \Storage::disk('public')->exists($testimonial->image)) {
                \Storage::disk('public')->delete($testimonial->image);
            }
            $testimonial->image = $request->file('image')->store('testimonials', 'public');
        }
        $testimonial->update([
            'author' => $request->author,
            'designation' => $request->designation,
            'text' => $request->text,
            'image' => $testimonial->image,
        ]);
        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    // Admin: Delete testimonial
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image && \Storage::disk('public')->exists($testimonial->image)) {
            \Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();
        return redirect()->route('dashboard.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
