<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        // Basic validation for name
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Update name
        $user->name = $request->input('name');

        // Check if password update is requested
        if ($request->filled('new_password')) {
            // Validate password fields only if new password is provided
            $request->validate([
                'old_password' => 'required|string',
                'new_password' => 'required|string|min:6|confirmed',
            ]);

            // Verify old password
            if (!Hash::check($request->input('old_password'), $user->password)) {
                return back()->withErrors(['old_password' => 'The old password is incorrect.']);
            }

            // Update password
            $user->password = Hash::make($request->input('new_password'));
        }

        // Save changes
        $user->save();

        // Always logout user after any update
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login with appropriate message
        $message = $request->filled('new_password') 
            ? 'Profile and password updated successfully. Please login again.'
            : 'Name updated successfully. Please login again.';

        return redirect('/login')->with('success', $message);
    }
}