<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AdminLocationController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OrderController;
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

    Route::get('categories/{category}/products', [ProductController::class, 'productsByCategory']);

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

            Route::apiResource('orders', OrderController::class)->only('index', 'show', 'update', 'destroy');
            Route::post('orders/admin-store', [OrderController::class, 'adminStore']);
            Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus']);

            Route::apiResource('offers', OfferController::class);

            Route::apiResource('coupons', CouponController::class);

            Route::apiResource('ads', AdController::class);
        });

        // Customer only
        Route::middleware('role:customer')->group(function () {
            Route::apiResource('orders', OrderController::class)->only('store');
            Route::get('my-orders', [OrderController::class, 'myOrders']);

            Route::apiResource('locations', LocationController::class);

            Route::get('/cart', [CartController::class, 'index']);

            Route::post('/cart', [CartController::class, 'store']);

            Route::put('/cart/{cartItem}', [CartController::class, 'update']);

            Route::delete('/cart/{cartItem}', [CartController::class, 'destroy']);

            Route::delete('/cart', [CartController::class, 'clear']);

            Route::get('favorites', [FavoriteController::class, 'index']);

            Route::post('favorites', [FavoriteController::class, 'store']);

            Route::delete('favorites/{favorite}', [FavoriteController::class, 'destroy']);

            Route::post('coupons/check', [CouponController::class, 'check']);
        });

        // Admin + Customer Service
        Route::middleware('role:admin,customer_service')->group(function () {});
    });
});

Route::get('/verify-email/{id}', [AuthController::class, 'verify'])->name('verify.email');
