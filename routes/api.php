<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Get token for API client (PUT, DELETE, POST requests )
 */
Route::get('/csrf', function () {
    return csrf_token();
});

/**
 * Routes for products
 */

Route::apiResource('products', ProductController::class);
Route::post('/products/create', [ProductController::class, 'store']);

Route::get('/products/shop/{id}', [ProductController::class, 'getProductsByShop']);
Route::get('/products/category/{category}', [ProductController::class, 'getProductsByCategory']);
Route::get('/products/search/{name}', [ProductController::class, 'getProductsByName']);
Route::get('/products/price/{price}', [ProductController::class, 'getProductsByPrice']);
Route::get('/products/color/{color}', [ProductController::class, 'getProductsByColor']);
Route::get('/products/material/{material}', [ProductController::class, 'getProductsByMaterial']);
Route::get('/products/size/{size}', [ProductController::class, 'getProductsBySize']);

/**
 * Routes for users
 */
Route::apiResource('users', ProfileController::class);
Route::post('/users/create', [ProfileController::class, 'store']);

/**
 * Routes for orders
 */

Route::apiResource('orders', OrderController::class);
Route::post('/orders/create', [OrderController::class, 'store']);

/**
 * Routes for shops
 */
Route::apiResource('shops', ShopController::class);
Route::post('/shops/create', [ShopController::class, 'store']);

/**
 * Routes for the auth
 */
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [ProfileController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [ProfileController::class, 'userDetails']);
    Route::get('/logout', [ProfileController::class, 'logout']);
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
