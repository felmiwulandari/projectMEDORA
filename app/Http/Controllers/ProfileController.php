<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('pages.profile.index', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function save(Request $request) 
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,'. $user->id,
            'password' => 'nullable|string|min:8|confirmed|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[!@#$%^&*?]/',
        ], [
            'password.regex' => 'Password must contain at least one uppercase, one lowercase, one number, and one special character (!@#$%^&*?)',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }
}