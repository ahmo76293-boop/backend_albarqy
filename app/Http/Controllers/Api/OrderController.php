<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::with([
            'user',
            'location',
            'items.product',
            'items.unit'
        ])
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
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

                $product = Product::findOrFail($item['product_id']);

                // Get the selected unit for this product
                $unit = $product->units()
                    ->where('unit_id', $item['unit_id'])
                    ->first();

                if (!$unit) {
                    throw new \Exception('The selected unit does not belong to this product.');
                }

                $price = $unit->pivot->price;

                $total = $price * $item['quantity'];

                $subtotal += $total;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'unit_id'    => $unit->id,
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
}
