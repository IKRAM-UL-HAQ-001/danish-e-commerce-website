<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    public function toggleStatus(Request $request)
    {
        $user = User::where('slug', $request->slug)->firstOrFail();
        $user->update([
            'status' => !$user->status
        ]);

        $statusText = $user->status ? 'activated' : 'deactivated';
        return back()->with('success', "User account {$statusText} successfully.");
    }

    public function destroy(Request $request)
    {
        $user = User::where('slug', $request->slug)->firstOrFail();
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }
        
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
