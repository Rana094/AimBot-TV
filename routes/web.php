<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Auth Routes (All Logged-in Users)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/channels/{id}/favorite', [UserController::class, 'toggleFavorite'])->name('user.channels.favorite');
});

// Admin-Only Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/channels/add', [AdminController::class, 'addChannel'])->name('admin.channels.add');
    Route::post('/admin/channels/upload-m3u', [AdminController::class, 'uploadM3u'])->name('admin.channels.upload-m3u');
    Route::delete('/admin/channels/delete/{id}', [AdminController::class, 'deleteChannel'])->name('admin.channels.delete');
    Route::post('/admin/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::delete('/admin/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

