<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\TelegramNotifyController;
use App\Http\Controllers\TelegramWebhookController;
use App\Models\catatan;
use App\Models\Tasklist;

Route::get('/', function () {
    return view('Onboarding');
})->name('onboarding');



Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('kegiatan', KegiatanController::class)->except('show');
    Route::resource('task', TaskListController::class);
    Route::resource('category', CategoryController::class)->except('show');
    Route::resource('catatan', CatatanController::class);

    Route::get('/telegram', [TelegramNotifyController::class, 'index'])->name('telegram.index');
    Route::post('/telegram', [TelegramNotifyController::class, 'update'])->name('telegram.update');
    Route::delete('/telegram', [TelegramNotifyController::class, 'destroy'])->name('telegram.destroy');

});



Route::post('/telegram/webhook', [TelegramWebhookController::class  , 'handle']);
Route::middleware('guest')->group(function () {
    Route::get('/auth/google', [SocialiteController::class, 'redirect'])->name('auth.google');
    Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
});

require __DIR__.'/auth.php';
