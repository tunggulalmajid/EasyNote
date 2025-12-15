<?php

use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', function () {
    return view('Onboarding');
})->name('onboarding');



Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardControler::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware('guest')->group(function () {
    Route::get('/auth/google', [SocialiteController::class, 'redirect'])->name('auth.google');
    Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
});

require __DIR__.'/auth.php';
