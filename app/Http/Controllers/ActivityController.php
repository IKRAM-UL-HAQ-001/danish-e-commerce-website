<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        // Admin sees all, Buyer sees theirs? The user is admin. Let's just show logs based on role.
        if (Auth::user()->isAdmin()) {
            $activities = ActivityLog::with('user')->latest()->paginate(20);
        } else {
            $activities = ActivityLog::with('user')->where('user_id', Auth::id())->latest()->paginate(20);
        }
        
        return view('dashboard.activities.index', compact('activities'));
    }

    public static function log($action, $description = null)
    {
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => $action,
                'description' => $description
            ]);
        }
    }
}
