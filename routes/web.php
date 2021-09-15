<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::resource('posts', PostController::class);
    Route::put('posts/publish/{post}', [PostController::class, 'publish'])->name('posts.publish');
    Route::get('posts/download/{post}', [PostController::class, 'download'])->name('posts.download');
    Route::resource('users', UserController::class);
    Route::resource('feedbacks', FeedbackController::class);
});

require __DIR__ . '/auth.php';
