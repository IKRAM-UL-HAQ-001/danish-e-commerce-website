<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('dashboard.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Faq::create($request->all());

        return back()->with('success', 'FAQ created successfully.');
    }

    public function update(Request $request)
    {
        $faq = Faq::where('slug', $request->slug)->firstOrFail();
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $faq->update($request->all());

        return back()->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Request $request)
    {
        $faq = Faq::where('slug', $request->slug)->firstOrFail();
        $faq->delete();
        return back()->with('success', 'FAQ deleted successfully.');
    }
}
