<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function editAbout()
    {
        $content = Setting::where('key', 'about_us_content')->first();
        $image = Setting::where('key', 'about_us_image')->first();
        return view('dashboard.pages.about', compact('content', 'image'));
    }

    public function updateAbout(Request $request)
    {
        Setting::updateOrCreate(
            ['key' => 'about_us_content'],
            ['value' => $request->content]
        );

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('about', 'public');
            Setting::updateOrCreate(
                ['key' => 'about_us_image'],
                ['value' => $imagePath]
            );
        }

        return back()->with('success', 'About Us page updated successfully.');
    }

    public function editContact()
    {
        $content = Setting::where('key', 'contact_us_content')->first();
        return view('dashboard.pages.contact', compact('content'));
    }

    public function updateContact(Request $request)
    {
        Setting::updateOrCreate(
            ['key' => 'contact_us_content'],
            ['value' => $request->content]
        );
        return back()->with('success', 'Contact Us page updated successfully.');
    }

    public function editTerms()
    {
        $content = Setting::where('key', 'terms_content')->first();
        return view('dashboard.pages.terms', compact('content'));
    }

    public function updateTerms(Request $request)
    {
        Setting::updateOrCreate(
            ['key' => 'terms_content'],
            ['value' => $request->content]
        );
        return back()->with('success', 'Terms and Conditions updated successfully.');
    }
}
