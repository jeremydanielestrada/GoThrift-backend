<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;



//Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);



Route::middleware('auth:sanctum')->group(function () {
    //Product Routes
    Route::apiResource('products',ProductController::class);

    //Cart Routes
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/${id}', [CartController::class, 'add']);
    Route::delete('/cart/${id}', [CartController::class, 'remove']);


    //User logout
    Route::get('/logout', [AuthController::class, 'logout']);
});
