<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupon\CheckCouponRequest;
use App\Http\Requests\Coupon\StoreCouponRequest;
use App\Http\Requests\Coupon\UpdateCouponRequest;
use App\Http\Resources\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Coupon::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where('code', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->boolean('status'));
        }

        // Filter by coupon type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $coupons = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $coupons = $query->get();
        }

        return CouponResource::collection($coupons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        DB::beginTransaction();

        try {

            $coupon = Coupon::create([

                'code' => strtoupper($request->code),

                'type' => $request->type,

                'value' => $request->value,

                'minimum_order_amount' => $request->minimum_order_amount ?? 0,

                'usage_limit' => $request->usage_limit,

                'used_count' => 0,

                'start_date' => $request->start_date,

                'end_date' => $request->end_date,

                'is_active' => $request->boolean('is_active'),
            ]);

            DB::commit();

            return response()->json([
                'message' => __('coupon.created'),
                'data' => new CouponResource($coupon),
            ], 201);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('coupon.create_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);

        return new CouponResource($coupon);
    }

    /**
     * Update the specified resource.
     */
    public function update(UpdateCouponRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $coupon = Coupon::findOrFail($id);

            $coupon->update([

                'code' => strtoupper($request->code),

                'type' => $request->type,

                'value' => $request->value,

                'minimum_order_amount' => $request->minimum_order_amount ?? 0,

                'usage_limit' => $request->usage_limit,

                'start_date' => $request->start_date,

                'end_date' => $request->end_date,

                'is_active' => $request->boolean('is_active'),
            ]);

            DB::commit();

            return response()->json([
                'message' => __('coupon.updated'),
                'data' => new CouponResource(
                    $coupon->fresh()
                ),
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('coupon.update_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        try {

            $coupon = Coupon::findOrFail($id);

            $coupon->delete();

            return response()->json([
                'message' => __('coupon.deleted'),
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'message' => __('coupon.delete_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function check(CheckCouponRequest $request)
    {
        $coupon = Coupon::where(
            'code',
            strtoupper($request->coupon_code)
        )
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->first();


        if (!$coupon) {

            return response()->json([
                'message' => __('coupon.invalid'),
            ], 422);
        }


        if (
            $coupon->usage_limit !== null &&
            $coupon->used_count >= $coupon->usage_limit
        ) {

            return response()->json([
                'message' => __('coupon.limit_reached'),
            ], 422);
        }


        $discount = 0;


        if ($request->filled('subtotal')) {


            if (
                $coupon->minimum_order_amount &&
                $request->subtotal < $coupon->minimum_order_amount
            ) {

                return response()->json([
                    'message' => __('coupon.minimum_order'),
                ], 422);
            }


            if ($coupon->type === 'percentage') {

                $discount =
                    ($request->subtotal * $coupon->value) / 100;
            } else {

                $discount = $coupon->value;
            }


            $discount = min(
                $discount,
                $request->subtotal
            );
        }


        return response()->json([

            'message' => __('coupon.valid'),

            'data' => [

                'code' => $coupon->code,

                'type' => $coupon->type,

                'value' => (float) $coupon->value,

                'discount_amount' => (float) $discount,

                'minimum_order_amount' =>
                (float) $coupon->minimum_order_amount,

                'start_date' => $coupon->start_date,

                'end_date' => $coupon->end_date,

            ]

        ]);
    }
}
