<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::resource('feedbacks', FeedbackController::class);
});

require __DIR__ . '/auth.php';
