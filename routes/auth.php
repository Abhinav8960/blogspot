<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\auth\SubscriptionController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    //can create your own post
    // Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/myposts/{id}', [HomeController::class, 'userPosts'])->name('home.userposts');
    Route::get('/userposts/edit/{id}', [HomeController::class, 'userPostsedit'])->name('home.userpostsedit');
    Route::post('/userposts/update/{id}', [HomeController::class, 'userPostsupdate'])->name('home.userpostsupdate');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::post('/profile/subscription', [SubscriptionController::class, 'storeSubscription'])->name('profile.subscription.store');

    //blogs 
    Route::get('/myblogs/{id}', [HomeController::class, 'userBlogs'])->name('home.userblogs');
    Route::get('/userblogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/userblogs/{userId}', [HomeController::class, 'userBlogs'])->name('home.userblogs');
    Route::get('/userblogsdetail/{id}', [HomeController::class, 'userblogsdetail'])->name('home.userblogsdetail');
    Route::post('/userblogsdetail/{id}/send-for-approval', [HomeController::class, 'blogsendforapproval'])->name('home.blogsendforapproval');
    Route::delete('/userblogsdetail/{id}', [HomeController::class, 'blogdestroy'])->name('home.blogdestroy');
    Route::get('/userblogsedit/{id}', [HomeController::class, 'blogsedit'])->name('home.blogsedit');
    Route::post('/blogsupdate/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::get('/userblogspendingforapproval/{id}', [HomeController::class, 'userblogspendingforapproval'])->name('home.userblogspendingforapproval');
});
