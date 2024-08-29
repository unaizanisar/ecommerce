<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ApiLoginController;
use App\Http\Controllers\Api\Auth\ApiRegisterController;
use App\Http\Controllers\Api\Admin\ApiUserController;
use App\Http\Controllers\Api\Backend\ApiCategoryController;
use App\Http\Controllers\Api\Backend\ApiProductController;


// Public routes
Route::post('login', [ApiLoginController::class, 'login']);
Route::post('register', [ApiRegisterController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [ApiLoginController::class, 'logout']);

    Route::get('users', [ApiUserController::class, 'index']);
    Route::get('users/{id}',[ApiUserController::class, 'show']);
    Route::post('users',[ApiUserController::class, 'store']);
    Route::post('users/{id}',[ApiUserController::class, 'update']);
    Route::delete('users/{id}', [ApiUserController::class, 'destroy']);
    Route::patch('users/{id}/status/{status}',[ApiUserController::class, 'updateStatus']);

    Route::get('category', [ApiCategoryController::class, 'index']);
    Route::get('category/{id}',[ApiCategoryController::class, 'show']);
    Route::post('category',[ApiCategoryController::class, 'store']);
    Route::post('category/{id}',[ApiCategoryController::class, 'update']);
    Route::delete('category/{id}', [ApiCategoryController::class, 'destroy']);
    Route::patch('category/{id}/status/{status}',[ApiCategoryController::class, 'updateStatus']);

    Route::get('product', [ApiProductController::class, 'index']);
    Route::get('product/{id}',[ApiProductController::class, 'show']);
    Route::post('product',[ApiProductController::class, 'store']);
    Route::post('product/{id}',[ApiProductController::class, 'update']);
    Route::delete('product/{id}', [ApiProductController::class, 'destroy']);
    Route::patch('product/{id}/status/{status}',[ApiProductController::class, 'updateStatus']);
});
