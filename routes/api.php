<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;



//Authentication Routes
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');



Route::middleware('auth:sanctum')->group(function () {
    //Product Routes
    Route::apiResource('products',ProductController::class);

     // Override the update route to accept POST(Required when using multi-form data/ method spoof the form data when testing to postman)
    Route::post('/products/{product}', [ProductController::class, 'update'])->name('update');

    //Cart Routes
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/${id}', [CartController::class, 'add']);
    Route::delete('/cart/${id}', [CartController::class, 'remove']);


    //User logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
