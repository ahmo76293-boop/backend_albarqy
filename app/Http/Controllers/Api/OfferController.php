<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use App\Models\ProductUnit;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::with([
            'productUnit.product',
            'productUnit.unit',
        ])->latest()->paginate(10);

        return OfferResource::collection($offers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request)
    {
        DB::beginTransaction();

        try {

            $productUnit = ProductUnit::where([
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
            ])->first();

            if (!$productUnit) {
                return response()->json([
                    'message' => __('offer.invalid_product_unit'),
                ], 422);
            }

            $offer = Offer::create([

                'product_unit_id' => $productUnit->id,

                'type' => $request->type,

                'value' => $request->value,

                'start_date' => $request->start_date,

                'end_date' => $request->end_date,

                'is_active' => $request->boolean('is_active'),

            ]);

            DB::commit();

            return response()->json([
                'message' => __('offer.created'),
                'data' => new OfferResource(
                    $offer->load(
                        'productUnit.product',
                        'productUnit.unit'
                    )
                ),
            ], 201);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('offer.create_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $offer = Offer::with([
            'productUnit.product',
            'productUnit.unit',
        ])->findOrFail($id);

        return new OfferResource($offer);
    }

    /**
     * Update the specified resource.
     */
    public function update(UpdateOfferRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $offer = Offer::findOrFail($id);

            $productUnit = ProductUnit::where([
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
            ])->first();

            if (!$productUnit) {
                return response()->json([
                    'message' => __('offer.invalid_product_unit'),
                ], 422);
            }

            $offer->update([

                'product_unit_id' => $productUnit->id,

                'type' => $request->type,

                'value' => $request->value,

                'start_date' => $request->start_date,

                'end_date' => $request->end_date,

                'is_active' => $request->boolean('is_active'),

            ]);

            DB::commit();

            return response()->json([
                'message' => __('offer.updated'),
                'data' => new OfferResource(
                    $offer->fresh()->load(
                        'productUnit.product',
                        'productUnit.unit'
                    )
                ),
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('offer.update_failed'),
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

            $offer = Offer::findOrFail($id);

            $offer->delete();

            return response()->json([
                'message' => __('offer.deleted'),
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'message' => __('offer.delete_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
