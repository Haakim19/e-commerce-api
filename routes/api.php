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

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// Public Endpoints
Route::apiResource('products', ProductController::class)
    ->only(['index', 'show']);

// Protected Endpoints
Route::apiResource('products', ProductController::class)
    ->only(['update', 'destroy', 'store'])
    ->middleware(['auth:sanctum', AdminMiddleware::class]);

// Place the specific route first
Route::get(
    '/customers/all-orders',
    [CustomerController::class, 'getAllCustomerOrders']
);
Route::get(
    '/customers/{userId}/orders',
    [CustomerController::class, 'getCustomerOrders']
);
Route::apiResource('customers', CustomerController::class)
    ->only(['index', 'show']);
