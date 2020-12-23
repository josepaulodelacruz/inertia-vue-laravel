<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/users/{user}/view', [UserController::class, 'show'])->name('post.view');

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store'])->name('posts');
Route::delete('/posts/{post}/delete', [PostController::class, 'destroy']);

Route::post('/posts/{post}/like', [PostLikeController::class, 'store'])->name('post.like');






