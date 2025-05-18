<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Show admin dashboard with user list and search.
     */
    public function index(Request $request)
    {
        if (!session('admin_key')) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('key', 'like', "%$search%");
            });
        }

        $users = $query->get();
        return view('admin.index', compact('users'));
    }

    /**
     * Show the edit form.
     */
    public function edit(User $user)
    {
        if (!session('admin_key')) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return view('admin.edit', compact('user'));
    }

    /**
     * Update the user.
     */
    public function update(Request $request, User $user)
    {
        if (!session('admin_key')) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'suffix' => 'nullable|string',
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer|min:1|max:999',
            'birthdate' => 'required|date',
        ]);

        $user->update($validated);

        return redirect('/admin')->with('status', 'User updated successfully.');
    }

    /**
     * Save a new user.
     */
    public function store(Request $request)
    {
        if (!session('admin_key')) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'suffix' => 'nullable|string',
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer|min:1|max:999',
            'birthdate' => 'required|date',
        ]);

        do {
            $key = str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (User::where('key', $key)->exists());

        User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'suffix' => $validated['suffix'],
            'sex' => $validated['sex'],
            'age' => $validated['age'],
            'birthdate' => $validated['birthdate'],
            'key' => $key,
        ]);

        return redirect('/admin')->with('status', 'User created with key: ' . $key);
    }

    /**
     * Delete user.
     */
    public function destroy(User $user)
    {
        if (!session('admin_key')) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $user->delete();
        return redirect('/admin')->with('status', 'User deleted.');
    }
}
