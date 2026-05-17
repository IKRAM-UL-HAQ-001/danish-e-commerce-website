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
        dd([
            'has_file' => $request->hasFile('site_logo'),
            'file_details' => $request->file('site_logo'),
            'upload_error' => isset($_FILES['site_logo']) ? $_FILES['site_logo']['error'] : 'No file key in $_FILES',
            'all_inputs' => $request->except('_token'),
        ]);
    }
}
