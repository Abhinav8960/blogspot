<?php

use App\Http\Controllers\Payments\RazorpayController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\SubscriptionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = \App\Models\User::updateOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
        ]
    );

    Auth::login($user);

    return redirect('/');
});


// Public routes
Route::get('/', [HomeController::class, 'homepage'])->name('welcome');
Route::get('/home', [HomeController::class, 'homepage'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

Route::get('/posts', [HomeController::class, 'posts'])->name('posts');
Route::get('/post', [HomeController::class, 'post'])->name('post');
Route::get('/postdetails/{id}', [HomeController::class, 'postdetails'])->name('postdetails');

Route::get('/contactus', [HomeController::class, 'contactus'])->name('contactus');
Route::post('/contactus', [HomeController::class, 'Contactuscreate'])->name('Contactuscreate');
Route::post('/submit-quote', [QuoteController::class, 'store'])->name('quote.store');
// Authentication routes
require __DIR__ . '/auth.php';

// User Subscription Routes (User Payment)
Route::middleware(['auth'])
    ->prefix('subscription')
    ->name('subscription.')
    ->group(function () {
        Route::get('/payment', [SubscriptionController::class, 'showPayment'])->name('payment');
        Route::post('/process', [SubscriptionController::class, 'processPayment'])->name('process');
        Route::get('/success', [SubscriptionController::class, 'success'])->name('success');
        Route::get('/failed', [SubscriptionController::class, 'failed'])->name('failed');
        Route::post('/verify', [SubscriptionController::class, 'verifyPayment'])->name('verify');
    });

// Protected routes
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Posts
        Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
        Route::get('/posts/{id}', [PostsController::class, 'view'])->name('posts.view');
        Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('posts.edit');
        Route::post('/posts/update/{id}', [PostsController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{id}', [PostsController::class, 'delete'])->name('posts.delete');
        Route::patch('/posts/{id}/restore', [PostsController::class, 'restore'])->name('posts.restore');

        //blogs
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{id}', [BlogController::class, 'view'])->name('blogs.view');
        Route::get('/blogs/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::post('/blogs/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{id}', [BlogController::class, 'delete'])->name('blogs.delete');
        Route::patch('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore');

        // Contact
        Route::get('/contactus', [ContactUsController::class, 'index'])->name('contactus.index');
        Route::get('/contactus/{id}', [ContactUsController::class, 'view'])->name('contactus.view');
        Route::delete('/contactus/{id}', [ContactUsController::class, 'delete'])->name('contactus.delete');

        // Razorpay
        Route::get('/razorpay', [RazorpayController::class, 'index'])->name('razorpay.index');
        Route::post('/razorpay/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');
        Route::get('/razorpay/callback', [RazorpayController::class, 'callback'])->name('razorpay.callback');

        Route::get('/payment-success', fn() => view('payments.success'))->name('payment.success');
        Route::get('/payment-failed', fn() => view('payments.failed'))->name('payment.failed');

        Route::get('/log-check', function () {
            return file_get_contents(storage_path('logs/laravel.log'));
        });

        Route::get('/clear', function () {
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('config:cache');
            return "cleared";
        });
    });

// User Blog Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/userblogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/userblogs/{userId}', [HomeController::class, 'userBlogs'])->name('home.userblogs');
    Route::get('/userblogsdetail/{id}', [HomeController::class, 'userblogsdetail'])->name('home.userblogsdetail');
    Route::post('/userblogsdetail/{id}/send-for-approval', [HomeController::class, 'sendforapproval'])->name('home.sendForApproval');
    Route::delete('/userblogsdetail/{id}', [HomeController::class, 'destroy'])->name('home.destroy');
});
