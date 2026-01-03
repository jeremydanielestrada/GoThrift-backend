<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;



//Authentication Routes
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);



Route::middleware('auth:sanctum')->group(function () {


//User logout
Route::get('/logout', [AuthController::class, 'logout']);
});
