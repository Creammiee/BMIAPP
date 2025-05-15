<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Auto-redirect if already logged in as admin
        if (session('admin_key') === '12345') {
            return redirect('/admin');
        }

        return view('login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'key' => 'required|digits:5',
        ]);

        if ($request->key === '12345') {
            session(['admin_key' => $request->key]);
            return redirect('/admin');
        }

        // Simulated user record
        $user = [
            'name' => 'Test User',
            'age' => 21,
            'sex' => 'Female',
            'height' => 165,
            'weight' => 60,
            'bmi' => 21.5
        ];

        return view('user', compact('user'));
    }
}
