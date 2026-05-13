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
        return view('frontend.terms', compact('term'));
    }

    // Show the edit form in admin
    public function edit()
    {
        $term = Term::first();
        return view('dashboard.terms.edit', compact('term'));
    }

    // Update the terms content
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
        return redirect()->back()->with('success', 'Terms and Conditions updated successfully.');
    }
}
