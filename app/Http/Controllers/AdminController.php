<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function gate()
    {
        if (session('admin_key') === '12345') {
            $users = [
                ['key' => '12345', 'name' => 'Juan Dela Cruz', 'age' => 25, 'sex' => 'Male', 'height' => 170, 'weight' => 65, 'bmi' => 22.5],
                ['key' => '67890', 'name' => 'Maria Santos', 'age' => 30, 'sex' => 'Female', 'height' => 160, 'weight' => 55, 'bmi' => 21.5],
            ];
            return view('admin', compact('users'));
        }

        return view('login');
    }

    public function verifyKey(Request $request)
    {
        $request->validate([
            'key' => 'required|digits:5',
        ]);

        if ($request->key === '12345') {
            session(['admin_key' => $request->key]);
            return redirect('/admin');
        }

        return redirect('/admin')->with('error', 'Invalid key.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|digits:5',
            'name' => 'required|string',
            'age' => 'required|numeric|min:0',
            'sex' => 'required|string',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'bmi' => 'required|numeric',
        ]);

        // Save logic goes here (Firebase soon)

        return back()->with('status', "User created with key: {$request->key}");
    }

    public function destroy($key)
    {
        // Delete logic goes here (Firebase soon)

        return back()->with('status', "User {$key} deleted.");
    }
}
