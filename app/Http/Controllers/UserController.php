<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the login form for users.
     */
    public function showLoginForm()
    {
        return view('login'); // You must have resources/views/login.blade.php
    }

    /**
     * Process the login attempt via key.
     */
    public function login(Request $request)
    {
        $request->validate([
            'key' => 'required|digits:5'
        ]);

        // Admin key bypass
        if ($request->key === '12345') {
            session(['admin_key' => true]);
            return redirect('/admin');
        }

        $user = User::where('key', $request->key)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid code. Try again.');
        }

        session(['user_key' => $user->key]);

        return redirect('/user');
    }

    /**
     * Show the logged-in user's profile.
     */
    public function dashboard()
    {
        $key = session('user_key');

        if (!$key) {
            return redirect('/')->with('error', 'Please login first.');
        }

        $user = User::where('key', $key)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Invalid session. Try again.');
        }

        return view('user', compact('user'));
    }

    /**
     * Log the user out.
     */
    public function logout()
    {
        session()->forget('user_key');
        return redirect('/')->with('status', 'Logged out successfully.');
    }
}
