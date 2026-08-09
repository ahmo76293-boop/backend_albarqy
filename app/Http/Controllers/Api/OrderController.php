<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AssignDeliveryDriverRequest;
use App\Http\Requests\Order\CompleteDeliveryRequest;
use App\Http\Requests\Order\StoreAdminOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateDeliveryOrderStatusRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductUnit;
use App\Models\User;
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
            'deliveryDriver',
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
            'deliveryDriver',
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

            /*
        |--------------------------------------------------------------------------
        | Calculate products prices + normal offers
        |--------------------------------------------------------------------------
        */

            foreach ($request->items as $item) {

                $productUnit = ProductUnit::with('offers')
                    ->where('product_id', $item['product_id'])
                    ->where('unit_id', $item['unit_id'])
                    ->first();

                if (!$productUnit) {
                    throw new \Exception(
                        __('order.invalid_product_unit')
                    );
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
                    'is_gift' => false,
                ];
            }


            /*
        |--------------------------------------------------------------------------
        | Apply Gift Offers
        |--------------------------------------------------------------------------
        */

            foreach ($request->items as $item) {

                $productUnit = ProductUnit::where('product_id', $item['product_id'])
                    ->where('unit_id', $item['unit_id'])
                    ->first();

                if (!$productUnit) {
                    continue;
                }

                $purchaseQuantity = (int) $item['quantity'];

                /*
    |--------------------------------------------------------------------------
    | Get active gift offers for this product unit
    |--------------------------------------------------------------------------
    */

                $giftOffers = $productUnit->offers()
                    ->where('type', 'gift')
                    ->where('is_active', true)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->get();

                foreach ($giftOffers as $offer) {

                    if (!$offer->buy_quantity || !$offer->gift_quantity) {
                        continue;
                    }

                    /*
        |--------------------------------------------------------------------------
        | Check if customer qualifies
        |
        | Example:
        | buy_quantity = 2
        | gift_quantity = 1
        |
        | Buy 1  -> No gift
        | Buy 2  -> 1 gift
        | Buy 3  -> 1 gift
        | Buy 5  -> 1 gift
        |--------------------------------------------------------------------------
        */

                    if ($purchaseQuantity < $offer->buy_quantity) {
                        continue;
                    }

                    // Give exactly the configured gift quantity
                    $giftQuantity = $offer->gift_quantity;

                    /*
        |--------------------------------------------------------------------------
        | Get gift product unit
        |--------------------------------------------------------------------------
        */

                    $giftProductUnit = ProductUnit::find(
                        $offer->gift_product_unit_id
                    );

                    if (!$giftProductUnit) {
                        continue;
                    }

                    /*
        |--------------------------------------------------------------------------
        | Add gift as a free order item
        |--------------------------------------------------------------------------
        */

                    $itemsData[] = [

                        'product_id' => $giftProductUnit->product_id,

                        'unit_id' => $giftProductUnit->unit_id,

                        'quantity' => $giftQuantity,

                        'price' => 0,

                        'total' => 0,

                        'is_gift' => true,
                    ];
                }
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
                    throw new \Exception(
                        __('coupon.invalid')
                    );
                }

                if (
                    $coupon->usage_limit !== null &&
                    $coupon->used_count >= $coupon->usage_limit
                ) {
                    throw new \Exception(
                        __('coupon.limit_reached')
                    );
                }

                if (
                    $coupon->minimum_order_amount &&
                    $subtotal < $coupon->minimum_order_amount
                ) {
                    throw new \Exception(
                        __('coupon.minimum_order')
                    );
                }

                if ($coupon->type === 'percentage') {

                    $couponDiscount =
                        ($subtotal * $coupon->value) / 100;
                } else {

                    $couponDiscount =
                        $coupon->value;
                }

                $couponDiscount = min(
                    $couponDiscount,
                    $subtotal
                );
            }


            /*
        |--------------------------------------------------------------------------
        | Calculate final total
        |--------------------------------------------------------------------------
        */

            $discount = $request->discount ?? 0;

            $deliveryFee = $request->delivery_fee ?? 0;

            $total =
                $subtotal
                - $couponDiscount
                - $discount
                + $deliveryFee;


            /*
        |--------------------------------------------------------------------------
        | Create Order
        |--------------------------------------------------------------------------
        */

            $order = Order::create([

                'user_id' => auth()->id(),

                'location_id' => $request->location_id,

                'coupon_id' => $coupon?->id,

                'order_number' => 'ORD-' . time(),

                'subtotal' => $subtotal,

                'coupon_discount' => $couponDiscount,

                'delivery_fee' => $deliveryFee,

                'discount' => $discount,

                'total' => max(0, $total),

                'payment_method' => $request->payment_method,

                'payment_status' => 'pending',

                'status' => 'pending',

                'notes' => $request->notes,
            ]);


            /*
        |--------------------------------------------------------------------------
        | Create Order Items
        |--------------------------------------------------------------------------
        */

            foreach ($itemsData as $item) {

                OrderItem::create([

                    'order_id' => $order->id,

                    'product_id' => $item['product_id'],

                    'unit_id' => $item['unit_id'],

                    'quantity' => $item['quantity'],

                    'price' => $item['price'],

                    'total' => $item['total'],

                    // Only if your order_items table has this column
                    'is_gift' => $item['is_gift'],
                ]);
            }


            /*
        |--------------------------------------------------------------------------
        | Increase Coupon Usage
        |--------------------------------------------------------------------------
        */

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
            'deliveryDriver',
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

            $itemsData = [];

            /*
        |--------------------------------------------------------------------------
        | Calculate product prices + normal offers
        |--------------------------------------------------------------------------
        */

            foreach ($request->items as $item) {

                $productUnit = ProductUnit::with('offers')
                    ->where('product_id', $item['product_id'])
                    ->where('unit_id', $item['unit_id'])
                    ->first();

                if (!$productUnit) {
                    throw new \Exception(
                        __('order.invalid_product_unit')
                    );
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
                    'is_gift' => false,
                ];
            }


            /*
        |--------------------------------------------------------------------------
        | Apply Gift Offers
        |--------------------------------------------------------------------------
        */

            foreach ($request->items as $item) {

                $productUnit = ProductUnit::where('product_id', $item['product_id'])
                    ->where('unit_id', $item['unit_id'])
                    ->first();

                if (!$productUnit) {
                    continue;
                }

                $purchaseQuantity = (int) $item['quantity'];

                /*
            |--------------------------------------------------------------------------
            | Get active gift offers
            |--------------------------------------------------------------------------
            */

                $giftOffers = $productUnit->offers()
                    ->where('type', 'gift')
                    ->where('is_active', true)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->get();


                foreach ($giftOffers as $offer) {

                    if (
                        !$offer->buy_quantity ||
                        !$offer->gift_quantity
                    ) {
                        continue;
                    }


                    /*
                |--------------------------------------------------------------------------
                | Check qualification
                |
                | buy_quantity = 2
                | gift_quantity = 1
                |
                | Buy 1 -> no gift
                | Buy 2 -> 1 gift
                | Buy 3 -> 1 gift
                | Buy 5 -> 1 gift
                |--------------------------------------------------------------------------
                */

                    if ($purchaseQuantity < $offer->buy_quantity) {
                        continue;
                    }


                    /*
                |--------------------------------------------------------------------------
                | Give configured gift quantity
                |--------------------------------------------------------------------------
                */

                    $giftQuantity = $offer->gift_quantity;


                    /*
                |--------------------------------------------------------------------------
                | Get gift product unit
                |--------------------------------------------------------------------------
                */

                    $giftProductUnit = ProductUnit::find(
                        $offer->gift_product_unit_id
                    );

                    if (!$giftProductUnit) {
                        continue;
                    }


                    /*
                |--------------------------------------------------------------------------
                | Add gift item
                |--------------------------------------------------------------------------
                */

                    $itemsData[] = [

                        'product_id' => $giftProductUnit->product_id,

                        'unit_id' => $giftProductUnit->unit_id,

                        'quantity' => $giftQuantity,

                        'price' => 0,

                        'total' => 0,

                        'is_gift' => true,
                    ];
                }
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
                    throw new \Exception(
                        __('coupon.invalid')
                    );
                }


                if (
                    $coupon->usage_limit !== null &&
                    $coupon->used_count >= $coupon->usage_limit
                ) {
                    throw new \Exception(
                        __('coupon.limit_reached')
                    );
                }


                if (
                    $coupon->minimum_order_amount &&
                    $subtotal < $coupon->minimum_order_amount
                ) {
                    throw new \Exception(
                        __('coupon.minimum_order')
                    );
                }


                if ($coupon->type === 'percentage') {

                    $couponDiscount =
                        ($subtotal * $coupon->value) / 100;
                } else {

                    $couponDiscount =
                        $coupon->value;
                }


                $couponDiscount = min(
                    $couponDiscount,
                    $subtotal
                );
            }


            /*
        |--------------------------------------------------------------------------
        | Calculate final total
        |--------------------------------------------------------------------------
        */

            $discount = $request->discount ?? 0;

            $deliveryFee = $request->delivery_fee ?? 0;


            $total =
                $subtotal
                - $couponDiscount
                - $discount
                + $deliveryFee;


            /*
        |--------------------------------------------------------------------------
        | Create Order
        |--------------------------------------------------------------------------
        */

            $order = Order::create([

                // Admin chooses the customer
                'user_id' => $request->user_id,

                'location_id' => $request->location_id,

                'coupon_id' => $coupon?->id,

                'order_number' => 'ORD-' . time(),

                'subtotal' => $subtotal,

                'coupon_discount' => $couponDiscount,

                'delivery_fee' => $deliveryFee,

                'discount' => $discount,

                'total' => max(0, $total),

                'payment_method' => $request->payment_method,

                'payment_status' => 'pending',

                'status' => 'pending',

                'notes' => $request->notes,
            ]);


            /*
        |--------------------------------------------------------------------------
        | Create Order Items
        |--------------------------------------------------------------------------
        */

            foreach ($itemsData as $item) {

                OrderItem::create([

                    'order_id' => $order->id,

                    'product_id' => $item['product_id'],

                    'unit_id' => $item['unit_id'],

                    'quantity' => $item['quantity'],

                    'price' => $item['price'],

                    'total' => $item['total'],

                    'is_gift' => $item['is_gift'],
                ]);
            }


            /*
        |--------------------------------------------------------------------------
        | Increase Coupon Usage
        |--------------------------------------------------------------------------
        */

            if ($coupon) {
                $coupon->increment('used_count');
            }


            DB::commit();


            /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

            return response()->json([

                'message' => __('order.created'),

                'data' => new OrderResource(

                    $order->fresh()->load(
                        'user',
                        'location',
                        'coupon',
                        'items.product',
                        'items.unit',
                        'deliveryDriver'
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

    public function assignDeliveryDriver(
        AssignDeliveryDriverRequest $request,
        $id
    ) {
        $order = Order::findOrFail($id);

        // Check order status
        if (in_array($order->status, ['delivered', 'cancelled'])) {
            return response()->json([
                'message' => __('order.cannot_assign_delivery_driver'),
            ], 422);
        }

        // Find active delivery driver
        $driver = User::where('id', $request->delivery_driver_id)
            ->where('role', 'delivery')
            ->where('is_active', true)
            ->first();

        if (!$driver) {
            return response()->json([
                'message' => __('order.invalid_delivery_driver'),
            ], 422);
        }

        // Assign driver
        $order->update([
            'delivery_user_id' => $driver->id,
        ]);

        // Return updated order
        return response()->json([
            'message' => __('order.delivery_driver_assigned'),

            'data' => new OrderResource(
                $order->fresh()->load([
                    'user',
                    'location',
                    'deliveryDriver',
                    'items.product',
                    'items.unit',
                    'coupon',
                ])
            ),
        ]);
    }

    public function deliveryOrders(Request $request)
    {
        $query = Order::with([
            'user',
            'location',
            'items.product',
            'items.unit',
        ])
            ->where('delivery_user_id', auth()->id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
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

    public function updateDeliveryStatus(
        UpdateDeliveryOrderStatusRequest $request,
        $id
    ) {
        $order = Order::where('id', $id)
            ->where('delivery_user_id', auth()->id())
            ->firstOrFail();

        /*
    |--------------------------------------------------------------------------
    | Driver can only update shipped orders
    |--------------------------------------------------------------------------
    */

        if ($order->status !== 'shipped') {
            return response()->json([
                'message' => __('order.invalid_delivery_status'),
            ], 422);
        }

        /*
    |--------------------------------------------------------------------------
    | Update order status + payment status
    |--------------------------------------------------------------------------
    */

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return response()->json([
            'message' => __('order.status_updated'),

            'data' => new OrderResource(
                $order->fresh()->load([
                    'user',
                    'location',
                    'deliveryUser',
                    'coupon',
                    'items.product',
                    'items.unit',
                ])
            ),
        ]);
    }

    public function deliveryShow($id)
    {
        $order = Order::with([
            'user',
            'location',
            'deliveryDriver',
            'items.product',
            'items.unit',
            'coupon',
        ])
            ->where('delivery_user_id', auth()->id())
            ->findOrFail($id);

        return new OrderResource($order);
    }
}
