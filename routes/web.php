<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * Get token for API client (PUT, DELETE, POST requests )
 */
Route::get('/csrf', function () {
    return csrf_token();
});

/**
 * Routes for products
 */
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products/create', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

/**
 * Routes for users
 */
Route::get('/users', [ProfileController::class, 'index']);
Route::get('/users/{id}', [ProfileController::class, 'show']);
Route::post('/users/create', [ProfileController::class, 'store']);
Route::put('/users/{id}', [ProfileController::class, 'update']);
// Route::delete('/users/{id}', [ProfileController::class, 'destroy']);

/**
 * Routes for orders
 */
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders/create', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

/**
 * Routes for orders
 */
Route::get('/shops', [ShopController::class, 'index']);
Route::get('/shops/{id}', [ShopController::class, 'show']);
Route::post('/shops/create', [ShopController::class, 'store']);
//Route::put('/orders/{id}', [OrderController::class, 'update']);
//Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

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
