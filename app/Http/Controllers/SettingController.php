<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('dashboard.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        if ($request->hasFile('hero_image')) {
            $image = $request->file('hero_image');
            $imageName = 'hero_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('settings', $imageName, 'public');
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => 'storage/' . $path]);
            unset($data['hero_image']);
        }

        if ($request->hasFile('offer_bg')) {
            $image = $request->file('offer_bg');
            $imageName = 'offer_bg_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('settings', $imageName, 'public');
            Setting::updateOrCreate(['key' => 'offer_bg'], ['value' => 'storage/' . $path]);
            unset($data['offer_bg']);
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
