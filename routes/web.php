<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

Route::get('/', [ArticleController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ArticleController::class, 'dashboard'])->name('dashboard');

    Route::resource('articles', ArticleController::class)->except(['index']);
    Route::post('articles/{article}/comments', [CommentController::class, 'store'])->name('articles.comments.store');
});

Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');