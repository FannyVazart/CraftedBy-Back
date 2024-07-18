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


Route::get('/products/shop/{id}', [ProductController::class, 'getProductsByShop']);

Route::get('/products/category/{category}', [ProductController::class, 'getProductsByCategory']);
Route::get('/products/search/{name}', [ProductController::class, 'getProductsByName']);
Route::get('/products/price/{price}', [ProductController::class, 'getProductsByPrice']);
Route::get('/products/color/{color}', [ProductController::class, 'getProductsByColor']);
Route::get('/products/material/{material}', [ProductController::class, 'getProductsByMaterial']);
Route::get('/products/size/{size}', [ProductController::class, 'getProductsBySize']);

/**
 * Routes for orders
 */

Route::apiResource('orders', OrderController::class);
Route::post('/orders/create', [OrderController::class, 'store']);

Route::get('/orders/user/{id}', [OrderController::class, 'getOrdersByUser']);

/**
 * Routes for shops
 */
Route::apiResource('shops', ShopController::class);

Route::get('/shops/user/{id}', [ShopController::class, 'getShopsByUser']);

/**
 * Routes for the auth
 */

Route::post('/login', [ProfileController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [ProfileController::class, 'userDetails']);
    Route::get('/logout', [ProfileController::class, 'logout']);


    Route::post('/products/create', [ProductController::class, 'store']);
    Route::post('/shops/create', [ShopController::class, 'store']);
});

/**
 * Routes products in orders
 */
Route::post('/orders/{order_id}/products/{product_id}/{quantity}', [OrderController::class, 'addProductToOrder']);
Route::delete('/orders/{order_id}/products/{product_id}', [OrderController::class, 'removeProductFromOrder']);


/**
 * Routes for users
 */
Route::apiResource('users', ProfileController::class);
Route::post('/users/create', [ProfileController::class, 'store']);

/**
 * Routes for the dashboard (auth)
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
