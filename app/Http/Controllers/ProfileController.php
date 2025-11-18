<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view("profile.index", ["user" => $user]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users,email," . auth()->id(),
        ],[
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',
            'email.unique' => 'This email is already taken.',
        ]);

        $user = auth()->user();

        if ($user->name === $request->name && $user->email === $request->email) {
            return back()->with('info', 'No changes detected.');
        }

        if ($user->name !== $request->name) {
            $user->name = $request->name;
        }

        if ($user->email !== $request->email) {
            $user->email = $request->email;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "current_password" => "required",
            "password" => "required|string|min:8|confirmed",
        ],[
            'current_password.required' => 'Current password is required.',
            'password.required' => 'New password is required.',
            'password.string' => 'New password must be a string.',
            'password.min' => 'New password must be at least 8 characters long.',
            'password.confirmed' => 'New password confirmation does not match.',
        ]);

        $user = auth()->user();

        if(!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        if(Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'New password cannot be the same as the current password.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $user = auth()->user();
        auth()->logout();
        $user->delete();

        // Invalidate the session and regenerate CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/")->with('success', 'Your account has been deleted successfully.');
    }
}
