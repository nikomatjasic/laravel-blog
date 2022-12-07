<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post}', [PostController::class, 'show'])->name('category');


Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');
