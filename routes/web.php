<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'homepage'])->name('welcome');
Route::get('/home', [HomeController::class, 'homepage'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/post', [HomeController::class, 'post'])->name('post');
Route::get('/contactus', [HomeController::class, 'contactus'])->name('contactus');

Route::get('/postdetails/{id}', [HomeController::class, 'postdetails'])->name('postdetails');

// Authentication routes
require __DIR__ . '/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostsController::class, 'view'])->name('posts.view');
    Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/update/{id}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostsController::class, 'delete'])->name('posts.delete');

    // Add other protected routes here
});
