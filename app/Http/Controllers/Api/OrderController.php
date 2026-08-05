<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreAdminOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with([
            'user',
            'location',
            'items.product',
            'items.unit',
        ]);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by order status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $orders = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $orders = $query->get();
        }

        return OrderResource::collection($orders);
    }

    public function myOrders(Request $request)
    {
        $query = Order::with([
            'location',
            'items.product',
            'items.unit',
        ])
            ->where('user_id', auth()->id())
            ->latest();

        if ($request->boolean('paginate', true)) {
            return OrderResource::collection(
                $query->paginate($request->integer('per_page', 10))
            );
        }

        return OrderResource::collection(
            $query->get()
        );
    }

    /**
     * Store a newly created order.
     */
    public function store(StoreOrderRequest $request)
    {
        DB::beginTransaction();

        try {

            $subtotal = 0;

            $itemsData = [];

            // Calculate products prices
            foreach ($request->items as $item) {

                $productUnit = ProductUnit::where('product_id', $item['product_id'])
                    ->where('unit_id', $item['unit_id'])
                    ->first();

                if (!$productUnit) {
                    throw new \Exception('The selected unit does not belong to this product.');
                }


                $priceData = $productUnit->getFinalPrice();

                $price = $priceData['final_price'];

                $total = $price * $item['quantity'];

                $subtotal += $total;


                $itemsData[] = [
                    'product_id' => $productUnit->product_id,
                    'unit_id' => $productUnit->unit_id,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'total' => $total,
                ];
            }


            // Apply coupon
            $coupon = null;
            $couponDiscount = 0;


            if ($request->filled('coupon_code')) {

                $coupon = Coupon::where('code', strtoupper($request->coupon_code))
                    ->where('is_active', true)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->first();


                if (!$coupon) {
                    throw new \Exception(__('coupon.invalid'));
                }


                if (
                    $coupon->usage_limit !== null &&
                    $coupon->used_count >= $coupon->usage_limit
                ) {
                    throw new \Exception(__('coupon.limit_reached'));
                }


                if (
                    $coupon->minimum_order_amount &&
                    $subtotal < $coupon->minimum_order_amount
                ) {
                    throw new \Exception(__('coupon.minimum_order'));
                }


                if ($coupon->type === 'percentage') {

                    $couponDiscount = ($subtotal * $coupon->value) / 100;
                } else {

                    $couponDiscount = $coupon->value;
                }


                $couponDiscount = min($couponDiscount, $subtotal);
            }


            // Create order
            $order = Order::create([

                'user_id' => auth()->id(),

                'location_id' => $request->location_id,

                'coupon_id' => $coupon?->id,

                'order_number' => 'ORD-' . time(),

                'subtotal' => $subtotal,

                'coupon_discount' => $couponDiscount,

                'delivery_fee' => $request->delivery_fee ?? 0,

                'discount' => $request->discount ?? 0,

                'total' => $subtotal
                    - $couponDiscount
                    - ($request->discount ?? 0)
                    + ($request->delivery_fee ?? 0),

                'payment_method' => $request->payment_method,

                'payment_status' => 'pending',

                'status' => 'pending',

                'notes' => $request->notes,
            ]);


            // Create order items
            foreach ($itemsData as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'unit_id' => $item['unit_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                ]);
            }


            // Increase coupon usage
            if ($coupon) {
                $coupon->increment('used_count');
            }


            DB::commit();


            return response()->json([
                'message' => __('order.created'),
                'data' => new OrderResource(
                    $order->load(
                        'user',
                        'location',
                        'coupon',
                        'items.product',
                        'items.unit'
                    )
                ),
            ], 201);
        } catch (\Throwable $e) {

            DB::rollBack();


            return response()->json([
                'message' => __('order.create_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with([
            'user',
            'location',
            'items.product',
            'items.unit'
        ])->findOrFail($id);

        return new OrderResource($order);
    }

    /**
     * Update the specified order.
     */
    public function update(UpdateOrderRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $order = Order::with('items')->findOrFail($id);

            $subtotal = $order->items->sum('total');

            $deliveryFee = $request->delivery_fee ?? 0;
            $discount = $request->discount ?? 0;

            $order->update([
                'location_id' => $request->location_id,

                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_status,

                'status' => $request->status,

                'delivery_fee' => $deliveryFee,
                'discount' => $discount,

                'subtotal' => $subtotal,
                'total' => $subtotal + $deliveryFee - $discount,

                'notes' => $request->notes,
            ]);

            DB::commit();

            return response()->json([
                'message' => __('order.updated'),
                'data' => new OrderResource(
                    $order->fresh()->load(
                        'user',
                        'location',
                        'items.product',
                        'items.unit'
                    )
                )
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('order.update_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateStatus(UpdateOrderStatusRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $order = Order::findOrFail($id);

            $order->update([
                'status' => $request->status,
            ]);

            DB::commit();

            return response()->json([
                'message' => __('order.status_updated'),
                'data' => new OrderResource(
                    $order->fresh()->load(
                        'user',
                        'location',
                        'items.product',
                        'items.unit'
                    )
                ),
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('order.update_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified order.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return response()->json([
            'message' => __('order.deleted')
        ]);
    }

    public function adminStore(StoreAdminOrderRequest $request)
    {
        DB::beginTransaction();

        try {

            $subtotal = 0;

            $order = Order::create([
                'user_id' => $request->user_id,

                'location_id' => $request->location_id,

                'order_number' => 'ORD-' . time(),

                'subtotal' => 0,

                'delivery_fee' => $request->delivery_fee ?? 0,

                'discount' => $request->discount ?? 0,

                'coupon_discount' => 0,

                'total' => 0,

                'payment_method' => $request->payment_method,

                'payment_status' => 'pending',

                'status' => 'pending',

                'notes' => $request->notes,
            ]);


            foreach ($request->items as $item) {

                $productUnit = ProductUnit::where('product_id', $item['product_id'])
                    ->where('unit_id', $item['unit_id'])
                    ->first();


                if (!$productUnit) {
                    throw new \Exception('The selected unit does not belong to this product.');
                }


                $priceData = $productUnit->getFinalPrice();

                $price = $priceData['final_price'];

                $total = $price * $item['quantity'];

                $subtotal += $total;


                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productUnit->product_id,
                    'unit_id'    => $productUnit->unit_id,
                    'quantity'   => $item['quantity'],
                    'price'      => $price,
                    'total'      => $total,
                ]);
            }


            /*
        |--------------------------------------------------------------------------
        | Apply Coupon
        |--------------------------------------------------------------------------
        */

            $coupon = null;
            $couponDiscount = 0;


            if ($request->filled('coupon_code')) {


                $coupon = Coupon::where(
                    'code',
                    strtoupper($request->coupon_code)
                )
                    ->where('is_active', true)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->first();


                if (!$coupon) {
                    throw new \Exception(__('coupon.invalid'));
                }


                if (
                    $coupon->usage_limit !== null &&
                    $coupon->used_count >= $coupon->usage_limit
                ) {
                    throw new \Exception(__('coupon.limit_reached'));
                }


                if (
                    $coupon->minimum_order_amount &&
                    $subtotal < $coupon->minimum_order_amount
                ) {
                    throw new \Exception(__('coupon.minimum_order'));
                }



                if ($coupon->type === 'percentage') {

                    $couponDiscount = ($subtotal * $coupon->value) / 100;
                } else {

                    $couponDiscount = $coupon->value;
                }


                // prevent discount bigger than subtotal
                $couponDiscount = min($couponDiscount, $subtotal);
            }



            /*
        |--------------------------------------------------------------------------
        | Update Order Totals
        |--------------------------------------------------------------------------
        */

            $order->update([

                'coupon_id' => $coupon?->id,

                'subtotal' => $subtotal,

                'coupon_discount' => $couponDiscount,


                'total' =>
                $subtotal
                    - $couponDiscount
                    - $order->discount
                    + $order->delivery_fee,

            ]);



            if ($coupon) {
                $coupon->increment('used_count');
            }



            DB::commit();


            return response()->json([
                'message' => __('order.created'),

                'data' => new OrderResource(
                    $order->fresh()->load(
                        'user',
                        'location',
                        'coupon',
                        'items.product',
                        'items.unit'
                    )
                ),

            ], 201);
        } catch (\Throwable $e) {


            DB::rollBack();


            return response()->json([
                'message' => __('order.create_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
