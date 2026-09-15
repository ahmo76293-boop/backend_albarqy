<?php

use App\Http\Controllers\AboutUsController;
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
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProductImportController;
use Illuminate\Support\Facades\Route;

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

    Route::apiResource('offers', OfferController::class)->only(['index', 'show']);

    Route::apiResource('ads', AdController::class)->only(['index']);

    Route::apiResource(
        'about-us',
        AboutUsController::class
    )->only(['index']);

    Route::apiResource(
        'contact-infos',
        ContactInfoController::class
    )->only(['index']);

    Route::apiResource(
        'faqs',
        FaqController::class
    )->only(['index']);

    Route::apiResource(
        'privacy-policies',
        PrivacyPolicyController::class
    )->only(['index']);

    Route::get('categories/{category}/products', [ProductController::class, 'productsByCategory']);

    // Protected
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);

        Route::get(
            'notifications',
            [NotificationController::class, 'index']
        );

        Route::get(
            'notifications/{id}',
            [NotificationController::class, 'show']
        );

        Route::patch(
            'notifications/{id}/read',
            [NotificationController::class, 'markAsRead']
        );

        Route::patch(
            'notifications/read-all',
            [NotificationController::class, 'markAllAsRead']
        );

        Route::delete(
            'notifications/{id}',
            [NotificationController::class, 'destroy']
        );

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
            Route::patch('orders/{order}/delivery-fee', [OrderController::class, 'updateDeliveryFee']);

            Route::apiResource('offers', OfferController::class)->only(['store', 'update', 'destroy']);

            Route::apiResource('coupons', CouponController::class);

            Route::apiResource('ads', AdController::class)->only(['store', 'update', 'destroy', 'show']);

            Route::patch(
                'orders/{id}/delivery-driver',
                [OrderController::class, 'assignDeliveryDriver']
            );

            // -------------------------reports----------------------------------------------------
            // Sales
            Route::get(
                '/reports/sales',
                [ReportController::class, 'sales']
            );

            // Customers
            Route::get(
                '/reports/customers',
                [ReportController::class, 'customers']
            );

            // Products
            Route::get(
                '/reports/products',
                [ReportController::class, 'products']
            );

            // Orders
            Route::get(
                '/reports/orders',
                [ReportController::class, 'orders']
            );

            // Delivery drivers
            Route::get(
                '/reports/delivery-drivers',
                [ReportController::class, 'deliveryDrivers']
            );

            // Specific delivery driver
            Route::get(
                '/reports/delivery-drivers/{id}',
                [ReportController::class, 'deliveryDriver']
            );

            // Locations
            Route::get(
                '/reports/locations',
                [ReportController::class, 'locations']
            );

            Route::apiResource(
                'about-us',
                AboutUsController::class
            )->only(['store', 'update', 'destroy', 'show']);

            Route::apiResource(
                'contact-infos',
                ContactInfoController::class
            )->only(['store', 'update', 'destroy', 'show']);

            Route::apiResource(
                'faqs',
                FaqController::class
            )->only(['store', 'update', 'destroy', 'show']);

            Route::apiResource(
                'privacy-policies',
                PrivacyPolicyController::class
            )->only(['store', 'update', 'destroy', 'show']);

            Route::post(
                'products/import',
                [ProductImportController::class, 'import']
            );

            Route::post(
                'notifications',
                [NotificationController::class, 'store']
            );
            Route::delete('admin/notifications/{id}', [NotificationController::class, 'adminDestroy']);
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

        // Admin + Customer Service
        Route::middleware('role:delivery')->group(function () {
            Route::get(
                '/delivery/orders',
                [OrderController::class, 'deliveryOrders']
            );

            Route::get(
                '/delivery/orders/{id}',
                [OrderController::class, 'deliveryShow']
            );

            Route::patch(
                '/delivery/orders/{id}/status',
                [OrderController::class, 'updateDeliveryStatus']
            );

            Route::get(
                '/delivery/available-orders',
                [OrderController::class, 'availableDeliveryOrders']
            );

            Route::patch(
                '/delivery/orders/{id}/claim',
                [OrderController::class, 'claimDeliveryOrder']
            );
        });
    });
});

Route::get('/verify-email/{id}', [AuthController::class, 'verify'])->name('verify.email');
