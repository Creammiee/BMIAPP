<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = [
            'name' => $request->query('name'),
            'username' => $request->query('username'),
            'bmi' => $request->query('bmi'),
        ];

        return view('user', compact('user'));
    }
}
