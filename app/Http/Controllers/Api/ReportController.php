<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Sales Report
    |--------------------------------------------------------------------------
    */

    public function sales(Request $request)
    {
        $query = Order::whereNotIn('status', ['cancelled']);

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        return response()->json([
            'data' => [
                'total_sales' => (float) $query->sum('total'),

                'total_orders' => $query->count(),
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Customers Report
    |--------------------------------------------------------------------------
    */

    public function customers()
    {
        return response()->json([
            'data' => [
                'total_customers' => User::where(
                    'role',
                    'customer'
                )->count(),
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Products Report
    |--------------------------------------------------------------------------
    */

    public function products()
    {
        return response()->json([
            'data' => [
                'total_products' => Product::count(),
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Orders Report
    |--------------------------------------------------------------------------
    */

    public function orders(Request $request)
    {
        $query = Order::query();

        if ($request->filled('from')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->from
            );
        }

        if ($request->filled('to')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->to
            );
        }

        return response()->json([
            'data' => [
                'total_orders' => $query->count(),

                'pending' => (clone $query)
                    ->where('status', 'pending')
                    ->count(),

                'confirmed' => (clone $query)
                    ->where('status', 'confirmed')
                    ->count(),

                'processing' => (clone $query)
                    ->where('status', 'processing')
                    ->count(),

                'shipped' => (clone $query)
                    ->where('status', 'shipped')
                    ->count(),

                'delivered' => (clone $query)
                    ->where('status', 'delivered')
                    ->count(),

                'cancelled' => (clone $query)
                    ->where('status', 'cancelled')
                    ->count(),

                'total_amount' => (float) (clone $query)
                    ->whereNotIn('status', ['cancelled'])
                    ->sum('total'),
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Delivery Drivers Report
    |--------------------------------------------------------------------------
    */

    public function deliveryDrivers(Request $request)
    {
        $query = User::where('role', 'delivery');

        $drivers = $query->get()->map(function ($driver) use ($request) {

            $ordersQuery = Order::where(
                'delivery_user_id',
                $driver->id
            );

            if ($request->filled('from')) {
                $ordersQuery->whereDate(
                    'created_at',
                    '>=',
                    $request->from
                );
            }

            if ($request->filled('to')) {
                $ordersQuery->whereDate(
                    'created_at',
                    '<=',
                    $request->to
                );
            }

            return [
                'id' => $driver->id,

                'name' => $driver->name,

                'email' => $driver->email,

                'total_orders' => (clone $ordersQuery)
                    ->count(),

                'pending_orders' => (clone $ordersQuery)
                    ->where('status', 'pending')
                    ->count(),

                'processing_orders' => (clone $ordersQuery)
                    ->where('status', 'processing')
                    ->count(),

                'shipped_orders' => (clone $ordersQuery)
                    ->where('status', 'shipped')
                    ->count(),

                'delivered_orders' => (clone $ordersQuery)
                    ->where('status', 'delivered')
                    ->count(),

                'cancelled_orders' => (clone $ordersQuery)
                    ->where('status', 'cancelled')
                    ->count(),

                'total_sales' => (float) (clone $ordersQuery)
                    ->whereNotIn('status', ['cancelled'])
                    ->sum('total'),
            ];
        });

        return response()->json([
            'data' => $drivers,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Specific Delivery Driver Report
    |--------------------------------------------------------------------------
    */

    public function deliveryDriver(
        Request $request,
        $id
    ) {
        $driver = User::where('id', $id)
            ->where('role', 'delivery')
            ->firstOrFail();

        $query = Order::where(
            'delivery_user_id',
            $driver->id
        );

        if ($request->filled('from')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->from
            );
        }

        if ($request->filled('to')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->to
            );
        }

        return response()->json([
            'data' => [

                'driver' => [
                    'id' => $driver->id,
                    'name' => $driver->name,
                    'email' => $driver->email,
                ],

                'orders' => [
                    'total' => (clone $query)->count(),

                    'pending' => (clone $query)
                        ->where('status', 'pending')
                        ->count(),

                    'processing' => (clone $query)
                        ->where('status', 'processing')
                        ->count(),

                    'shipped' => (clone $query)
                        ->where('status', 'shipped')
                        ->count(),

                    'delivered' => (clone $query)
                        ->where('status', 'delivered')
                        ->count(),

                    'cancelled' => (clone $query)
                        ->where('status', 'cancelled')
                        ->count(),
                ],

                'total_sales' => (float) (clone $query)
                    ->whereNotIn('status', ['cancelled'])
                    ->sum('total'),
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Locations Report
    |--------------------------------------------------------------------------
    */

    public function locations()
    {
        return response()->json([
            'data' => [
                'total_locations' => Location::count(),
            ],
        ]);
    }
}
