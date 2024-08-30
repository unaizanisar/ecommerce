<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\ApiLoginController;
use App\Http\Controllers\Api\Auth\ApiRegisterController;
use App\Http\Controllers\Api\Admin\ApiUserController;
use App\Http\Controllers\Api\Admin\ApiProfileController;
use App\Http\Controllers\Api\Admin\ApiRoleController;
use App\Http\Controllers\Api\Admin\ApiPermissionController;
use App\Http\Controllers\Api\Backend\ApiCategoryController;
use App\Http\Controllers\Api\Backend\ApiProductController;
use App\Http\Controllers\Api\Backend\ApiOrderController;
use App\Http\Controllers\Api\Backend\ApiBannerController;

// Public routes
Route::post('login', [ApiLoginController::class, 'login']);
Route::post('register', [ApiRegisterController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [ApiLoginController::class, 'logout']);

    //Admin
    Route::get('users', [ApiUserController::class, 'index']);
    Route::get('users/{id}',[ApiUserController::class, 'show']);
    Route::post('users',[ApiUserController::class, 'store']);
    Route::post('users/{id}',[ApiUserController::class, 'update']);
    Route::delete('users/{id}', [ApiUserController::class, 'destroy']);
    Route::patch('users/{id}/status/{status}',[ApiUserController::class, 'updateStatus']);

    Route::get('profile',[ApiProfileController::class, 'show']);
    Route::post('profile',[ApiProfileController::class, 'update']);

    Route::get('role', [ApiRoleController::class, 'index']);
    Route::get('role/{id}', [ApiRoleController::class, 'show']);
    Route::post('role', [ApiRoleController::class, 'store']);
    Route::post('role/{id}', [ApiRoleController::class, 'update']);
    Route::delete('role/{id}', [ApiRoleController::class, 'destroy']);
    Route::patch('role/{id}/status/{status}', [ApiRoleController::class, 'updateStatus']);

    Route::get('permission', [ApiPermissionController::class, 'index']);
    Route::get('permission/{id}', [ApiPermissionController::class, 'show']);
    Route::post('permission', [ApiPermissionController::class, 'store']);
    Route::post('permission/{id}', [ApiPermissionController::class, 'update']);
    Route::delete('permission/{id}', [ApiPermissionController::class, 'destroy']);
    Route::patch('permission/{id}/status/{status}', [ApiPermissionController::class, 'updateStatus']);
//Backend
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

    Route::get('order', [ApiOrderController::class, 'index']);
    Route::get('order/{id}', [ApiOrderController::class, 'show']);
    Route::post('order', [ApiOrderController::class, 'store']);
    Route::post('order/{id}',[ApiOrderController::class, 'update']);
    Route::delete('order/{id}', [ApiOrderController::class, 'destroy']);
    Route::patch('order/{id}/status/{status}',[ApiOrderController::class, 'updateStatus']);
    
    Route::get('banner', [ApiBannerController::class, 'index']);
    Route::get('banner/{id}', [ApiBannerController::class, 'show']);
    Route::post('banner', [ApiBannerController::class, 'store']);
    Route::post('banner/{id}',[ApiBannerController::class, 'update']);
    Route::delete('banner/{id}', [ApiBannerController::class, 'destroy']);
    Route::patch('banner/{id}/status/{status}',[ApiBannerController::class, 'updateStatus']);
});
