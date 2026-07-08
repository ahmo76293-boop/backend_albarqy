<?php

use App\Http\Controllers\Api\AdminLocationController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => ['api', 'locale']], function () {
    // Public
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    // public catigories
    Route::apiResource('categories', CategoryController::class)
        ->only(['index', 'show']);

    // public units
    Route::apiResource('units', UnitController::class)
        ->only(['index', 'show']);

    // public products
    Route::apiResource('products', ProductController::class)
        ->only(['index', 'show']);

    // Protected
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);

        // Admin only
        Route::middleware('role:admin')->group(function () {
            Route::apiResource('categories', CategoryController::class)
                ->only(['store', 'update', 'destroy']);

            Route::apiResource('units', UnitController::class)
                ->only(['store', 'update', 'destroy']);

            Route::apiResource('products', ProductController::class)
                ->only(['store', 'update', 'destroy']);

            Route::apiResource('users', UserController::class);

            Route::apiResource('locations-admin', AdminLocationController::class);
        });

        // Customer only
        Route::middleware('role:customer')->group(function () {
            Route::apiResource('locations', LocationController::class);
        });

        // Admin + Customer Service
        Route::middleware('role:admin,customer_service')->group(function () {});
    });
});

Route::get('/verify-email/{id}', [AuthController::class, 'verify'])->name('verify.email');
