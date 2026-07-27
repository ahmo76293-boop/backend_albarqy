<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreAdminOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Requests\Order\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
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

            $order = Order::create([
                'user_id' => auth()->id(),

                'location_id' => $request->location_id,

                'order_number' => 'ORD-' . time(),

                'subtotal' => 0,

                'delivery_fee' => $request->delivery_fee ?? 0,

                'discount' => $request->discount ?? 0,

                'total' => 0,

                'payment_method' => $request->payment_method,

                'payment_status' => 'pending',

                'status' => 'pending',

                'notes' => $request->notes,
            ]);

            foreach ($request->items as $item) {

                // Get the selected unit for this product
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

            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $order->delivery_fee - $order->discount,
            ]);

            DB::commit();

            return response()->json([
                'message' => __('order.created'),
                'data' => new OrderResource(
                    $order->load(
                        'user',
                        'location',
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

                'total' => 0,

                'payment_method' => $request->payment_method,

                'payment_status' => 'pending',

                'status' => 'pending',

                'notes' => $request->notes,
            ]);

            foreach ($request->items as $item) {

                // Get the selected unit for this product
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

            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $order->delivery_fee - $order->discount,
            ]);

            DB::commit();

            return response()->json([
                'message' => __('order.created'),
                'data' => new OrderResource(
                    $order->load(
                        'user',
                        'location',
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
