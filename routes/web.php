<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/save', [AdminController::class, 'store']);
Route::delete('/admin/delete/{user}', [AdminController::class, 'destroy']);
Route::get('/admin/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update/{user}', [AdminController::class, 'update'])->name('admin.update');

Route::get('/', [UserController::class, 'showLoginForm']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'dashboard']);
Route::get('/logout', [UserController::class, 'logout']);
