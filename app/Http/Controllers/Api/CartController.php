<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the authenticated user's cart.
     */
    public function index(Request $request)
    {
        if ($request->boolean('paginate', true)) {
            $cart = CartItem::with([
                'product.category',
                'product.images',
                'product.productUnits',
                'unit'
            ])
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(10);
        } else {
            $cart = CartItem::with([
                'product.category',
                'product.images',
                'product.productUnits',
                'unit'
            ])
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return CartResource::collection($cart);
    }

    /**
     * Add a product to the cart.
     */
    public function store(AddToCartRequest $request)
    {
        DB::beginTransaction();

        try {

            $product = Product::findOrFail($request->product_id);

            $unit = $product->units()
                ->where('unit_id', $request->unit_id)
                ->first();

            if (!$unit) {
                return response()->json([
                    'message' => __('cart.unit_not_found'),
                ], 422);
            }

            $cartItem = CartItem::where([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
            ])->first();

            if ($cartItem) {

                $cartItem->increment('quantity', $request->quantity);
            } else {

                $cartItem = CartItem::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                    'unit_id' => $request->unit_id,
                    'quantity' => $request->quantity,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => __('cart.created'),
                'data' => new CartResource(
                    $cartItem->load(
                        'product.category',
                        'product.images',
                        'product.productUnits',
                        'unit'
                    )
                ),
            ], 201);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('cart.create_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display one cart item.
     */
    public function show($id)
    {
        $cartItem = CartItem::with([
            'product.category',
            'product.images',
            'product.productUnits',
            'unit'
        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return new CartResource($cartItem);
    }

    /**
     * Update cart item quantity.
     */
    public function update(UpdateCartRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $cartItem = CartItem::where('user_id', auth()->id())
                ->findOrFail($id);

            $cartItem->update([
                'quantity' => $request->quantity,
            ]);

            DB::commit();

            return response()->json([
                'message' => __('cart.updated'),
                'data' => new CartResource(
                    $cartItem->fresh()->load(
                        'product.category',
                        'product.images',
                        'product.productUnits',
                        'unit'
                    )
                ),
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('cart.update_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove a cart item.
     */
    public function destroy($id)
    {
        $cartItem = CartItem::where('user_id', auth()->id())
            ->findOrFail($id);

        $cartItem->delete();

        return response()->json([
            'message' => __('cart.deleted'),
        ]);
    }

    /**
     * Remove all items from the cart.
     */
    public function clear()
    {
        CartItem::where('user_id', auth()->id())->delete();

        return response()->json([
            'message' => __('cart.cleared'),
        ]);
    }
}
