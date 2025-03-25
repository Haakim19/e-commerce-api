<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\ProductController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//! Auth Routes
Route::controller(AuthController::class)->group(function () {
    // Public Routes
    Route::post('/login', 'login');
    Route::post('/register', 'register');

    // Protected Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
});

//! Product Routes
Route::prefix('products')->group(function () {
    // Public Routes
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{product}', [ProductController::class, 'show']);

    // Protected Admin Routes
    Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{product}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
    });
});

//! Customer Routes
Route::prefix('customers')->group(function () {
    // Regular customer routes
    Route::get('/', [CustomerController::class, 'index']);
    Route::get('/{id}', [CustomerController::class, 'show']);

    // Customer order routes
    Route::get('/all-orders', [CustomerController::class, 'getAllCustomerOrders']);
    Route::get('/{userId}/orders', [CustomerController::class, 'getCustomerOrders']);
});
