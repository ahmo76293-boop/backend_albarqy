<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UnitController;
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
        });

        // Customer only
        Route::middleware('role:customer')->group(function () {});

        // Admin + Customer Service
        Route::middleware('role:admin,customer_service')->group(function () {});
    });
});

Route::get('/verify-email/{id}', [AuthController::class, 'verify'])->name('verify.email');
