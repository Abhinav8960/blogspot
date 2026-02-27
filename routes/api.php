<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// get with route http://127.0.0.1:8001/api/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'products'])->name('products.index');
Route::get('/productnews', [ProductController::class, 'productnews'])->name('products.productnews');
