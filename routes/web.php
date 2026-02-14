<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessengerController;

Route::get('/', [PostController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class,'index']);
    Route::post('/posts', [PostController::class,'store']);
    Route::post('/like/{post}', [LikeController::class,'store']);
    Route::post('/comment/{post}', [CommentController::class,'store']);
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class,'dashboard']);
    Route::post('/admin/ban/{user}', [AdminController::class,'ban']);
    Route::delete('/admin/post/{post}', [AdminController::class,'deletePost']);
    Route::get('/admin/users', [AdminController::class,'users']);
    Route::post('/admin/users/{user}/ban', [AdminController::class,'ban']);
    Route::post('/admin/users/{user}/unban', [AdminController::class,'unban']);
    Route::delete('/admin/users/{user}', [AdminController::class,'destroy']);
    Route::post('/admin/users', [AdminController::class,'store']); // create
    Route::get('/admin/users/search', [AdminController::class,'search']);
    Route::get('/admin/settings', [AdminController::class,'settings'])->name('admin.settings');
    Route::post('/admin/settings/profile', [AdminController::class,'updateProfile'])->name('admin.settings.profile');
    Route::get('/admin/security', [AdminController::class,'security'])->name('admin.security');
    Route::post('/admin/security/password', [AdminController::class,'updatePassword'])->name('admin.security.password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/messages', [MessengerController::class,'index']);
    Route::get('/messages/{user}', [MessengerController::class,'open']);
    Route::post('/messages/{conversation}', [MessengerController::class,'send']);
});


require __DIR__.'/auth.php';
