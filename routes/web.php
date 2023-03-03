<?php

use App\Http\Controllers\ActivateUserController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ToggleFollowController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show'])
  ->name('category');
Route::post('posts/{post:slug}/comments',
  [PostCommentsController::class, 'store']);
Route::get('feed', FeedController::class);

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);
Route::get('activate/{hash}', [ActivateUserController::class, 'index']);
Route::post('activate-user/{hash}', [ActivateUserController::class, 'store']);
//Route::post('activate-user/{user:hash}', [ActivateUserController::class, 'store']);
Route::get('login', [SessionsController::class, 'create'])->name('login');
Route::post('sessions', [SessionsController::class, 'store']);

/*
 * Single action controller
 */
Route::post('newsletter', NewsletterController::class);

/**
 * Only authenticated users can access these routes.
 */
Route::middleware(['auth'])->group(function () {
  Route::post('logout', [SessionsController::class, 'destroy']);
  Route::post('toggle-follow', ToggleFollowController::class)->name('toggle.follow');
});

/**
 * Admin
 */
Route::middleware(['can:admin'])->group(function () {
    Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    Route::post('admin/posts/create', [AdminPostController::class, 'store']);
    Route::get('admin/posts', [AdminPostController::class, 'index']);
    Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});

