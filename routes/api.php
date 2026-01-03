<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;



//Authentication Routes
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);



Route::middleware('auth:sanctum')->group(function () {
    //Product Routes
    Route::apiResource('products',ProductController::class);


    //User logout
    Route::get('/logout', [AuthController::class, 'logout']);
});
