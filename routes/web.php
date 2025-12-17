<?php

use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\TaskListController;
use App\Models\catatan;
use App\Models\Tasklist;

Route::get('/', function () {
    return view('Onboarding');
})->name('onboarding');



Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardControler::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('kegiatan', KegiatanController::class)->except('show');
    Route::resource('task', TaskListController::class);
    Route::resource('category', CategoryController::class)->except('show');
    Route::resource('catatan', catatan::class);
});



Route::middleware('guest')->group(function () {
    Route::get('/auth/google', [SocialiteController::class, 'redirect'])->name('auth.google');
    Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
});

require __DIR__.'/auth.php';
