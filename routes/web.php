<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Login Page (shared for admin and users)
Route::get('/', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'processLogin']);

// Admin Routes
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/save', [AdminController::class, 'store']);
Route::delete('/admin/delete/{key}', [AdminController::class, 'destroy']);

// User Route
Route::get('/user', [UserController::class, 'show'])->name('user.show');

// Logout
Route::get('/logout', function () {
    session()->forget('admin_key');
    return redirect('/')->with('status', 'Logged out successfully.');
});
