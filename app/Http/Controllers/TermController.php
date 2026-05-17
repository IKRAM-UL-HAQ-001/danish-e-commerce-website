<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;

class TermController extends Controller
{
    // Show the terms page on frontend
    public function show()
    {
        $term = Term::first();
        $sections = \App\Models\TermSection::orderBy('order')->get();
        return view('frontend.terms', compact('term', 'sections'));
    }

    // Show the edit form in admin
    public function edit()
    {
        $term = Term::first();
        $sections = \App\Models\TermSection::orderBy('order')->get();
        return view('dashboard.terms.edit', compact('term', 'sections'));
    }

    // Update the main terms content
    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        $term = Term::first();
        if (!$term) {
            $term = Term::create(['content' => $request->content]);
        } else {
            $term->update(['content' => $request->content]);
        }
        return redirect()->back()->with('success', 'Main title updated successfully.');
    }

    // Store a new section
    public function storeSection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        \App\Models\TermSection::create($request->all());

        return redirect()->back()->with('success', 'Section added successfully.');
    }

    // Update a section
    public function updateSection(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:term_sections,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $section = \App\Models\TermSection::findOrFail($request->id);
        $section->update($request->all());

        return redirect()->back()->with('success', 'Section updated successfully.');
    }

    // Delete a section
    public function deleteSection(Request $request)
    {
        $section = \App\Models\TermSection::findOrFail($request->id);
        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }
}
