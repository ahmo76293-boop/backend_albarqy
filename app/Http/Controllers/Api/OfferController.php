<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\StoreOfferRequest;
use App\Http\Requests\Offer\UpdateOfferRequest;
use App\Http\Resources\OfferResource;
use App\Jobs\CompressOfferImage;
use App\Models\Offer;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    /**
     * Display a listing of offers.
     */
    public function index(Request $request)
    {
        $query = Offer::with([
            'productUnits.product',
            'productUnits.unit',
            'giftProductUnit.product',
            'giftProductUnit.unit',
        ]);

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title_en', 'like', "%{$search}%")
                    ->orWhere('title_ar', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%")
                    ->orWhere('description_ar', 'like', "%{$search}%")
                    ->orWhereHas('productUnits.product', function ($q) use ($search) {
                        $q->where('name_en', 'like', "%{$search}%")
                            ->orWhere('name_ar', 'like', "%{$search}%")
                            ->orWhere('barcode', 'like', "%{$search}%")
                            ->orWhere('unique_number', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where(
                'is_active',
                $request->boolean('status')
            );
        }

        // Filter by offer type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by product
        if ($request->filled('product_id')) {

            $query->whereHas('productUnits', function ($q) use ($request) {
                $q->where('product_id', $request->product_id);
            });
        }

        // Filter by unit
        if ($request->filled('unit_id')) {

            $query->whereHas('productUnits', function ($q) use ($request) {
                $q->where('unit_id', $request->unit_id);
            });
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {

            $offers = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {

            $offers = $query->get();
        }

        return OfferResource::collection($offers);
    }


    /**
     * Store a newly created offer.
     */
    public function store(StoreOfferRequest $request)
    {
        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Get Product Units
            |--------------------------------------------------------------------------
            */

            $productUnitIds = [];

            foreach ($request->products as $product) {

                $productUnit = ProductUnit::where(
                    'product_id',
                    $product['product_id']
                )
                    ->where(
                        'unit_id',
                        $product['unit_id']
                    )
                    ->first();

                if (!$productUnit) {

                    throw new \Exception(
                        __('offer.invalid_product_unit')
                    );
                }

                $productUnitIds[] = $productUnit->id;
            }


            /*
            |--------------------------------------------------------------------------
            | Gift Product Unit
            |--------------------------------------------------------------------------
            */

            $giftProductUnitId = null;

            if ($request->type === 'gift') {

                $giftProductUnit = ProductUnit::where(
                    'product_id',
                    $request->gift_product_id
                )
                    ->where(
                        'unit_id',
                        $request->gift_unit_id
                    )
                    ->first();

                if (!$giftProductUnit) {

                    throw new \Exception(
                        __('offer.invalid_product_unit')
                    );
                }

                $giftProductUnitId = $giftProductUnit->id;
            }


            /*
            |--------------------------------------------------------------------------
            | Create Offer
            |--------------------------------------------------------------------------
            */

            $offer = Offer::create([

                'title_en' => $request->title_en,

                'title_ar' => $request->title_ar,

                'description_en' => $request->description_en,

                'description_ar' => $request->description_ar,

                'type' => $request->type,

                'value' => $request->type === 'gift'
                    ? null
                    : $request->value,

                'buy_quantity' => $request->type === 'gift'
                    ? $request->buy_quantity
                    : null,

                'gift_product_unit_id' => $giftProductUnitId,

                'gift_quantity' => $request->type === 'gift'
                    ? $request->gift_quantity
                    : null,

                'start_date' => $request->start_date,

                'end_date' => $request->end_date,

                'is_active' => $request->boolean('is_active'),
            ]);


            /*
            |--------------------------------------------------------------------------
            | Upload Image
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('image')) {

                $imagePath = $request->file('image')
                    ->store('offers', 'public');

                $offer->update([
                    'image' => $imagePath,
                ]);

                CompressOfferImage::dispatch($imagePath);
            }


            /*
            |--------------------------------------------------------------------------
            | Attach Product Units
            |--------------------------------------------------------------------------
            */

            $offer->productUnits()->sync($productUnitIds);


            DB::commit();

            return response()->json([

                'message' => __('offer.created'),

                'data' => new OfferResource(

                    $offer->fresh()->load([
                        'productUnits.product',
                        'productUnits.unit',
                        'giftProductUnit.product',
                        'giftProductUnit.unit',
                    ])

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
     * Display the specified offer.
     */
    public function show($id)
    {
        $offer = Offer::with([
            'productUnits.product',
            'productUnits.unit',
            'giftProductUnit.product',
            'giftProductUnit.unit',
        ])->findOrFail($id);

        return new OfferResource($offer);
    }


    /**
     * Update the specified offer.
     */
    public function update(
        UpdateOfferRequest $request,
        $id
    ) {
        DB::beginTransaction();

        try {

            $offer = Offer::findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $data = [];

            if ($request->has('title_en')) {
                $data['title_en'] = $request->title_en;
            }

            if ($request->has('title_ar')) {
                $data['title_ar'] = $request->title_ar;
            }

            if ($request->has('description_en')) {
                $data['description_en'] = $request->description_en;
            }

            if ($request->has('description_ar')) {
                $data['description_ar'] = $request->description_ar;
            }


            /*
            |--------------------------------------------------------------------------
            | Type
            |--------------------------------------------------------------------------
            */

            if ($request->has('type')) {

                $data['type'] = $request->type;

                if ($request->type === 'gift') {

                    $data['value'] = null;
                } else {

                    $data['buy_quantity'] = null;
                    $data['gift_product_unit_id'] = null;
                    $data['gift_quantity'] = null;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Value
            |--------------------------------------------------------------------------
            */

            if ($request->has('value')) {
                $data['value'] = $request->value;
            }


            /*
            |--------------------------------------------------------------------------
            | Gift
            |--------------------------------------------------------------------------
            */

            if (
                $request->has('gift_product_id') ||
                $request->has('gift_unit_id')
            ) {

                if (
                    !$request->filled('gift_product_id') ||
                    !$request->filled('gift_unit_id')
                ) {

                    throw new \Exception(
                        __('offer.invalid_product_unit')
                    );
                }

                $giftProductUnit = ProductUnit::where(
                    'product_id',
                    $request->gift_product_id
                )
                    ->where(
                        'unit_id',
                        $request->gift_unit_id
                    )
                    ->first();

                if (!$giftProductUnit) {

                    throw new \Exception(
                        __('offer.invalid_product_unit')
                    );
                }

                $data['gift_product_unit_id'] = $giftProductUnit->id;
            }


            if ($request->has('buy_quantity')) {

                $data['buy_quantity'] =
                    $request->buy_quantity;
            }


            if ($request->has('gift_quantity')) {

                $data['gift_quantity'] =
                    $request->gift_quantity;
            }


            /*
            |--------------------------------------------------------------------------
            | Dates
            |--------------------------------------------------------------------------
            */

            if ($request->has('start_date')) {

                $data['start_date'] =
                    $request->start_date;
            }

            if ($request->has('end_date')) {

                $data['end_date'] =
                    $request->end_date;
            }


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            if ($request->has('is_active')) {

                $data['is_active'] =
                    $request->boolean('is_active');
            }


            /*
            |--------------------------------------------------------------------------
            | Replace Image
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('image')) {

                if ($offer->image) {

                    Storage::disk('public')
                        ->delete($offer->image);
                }

                $imagePath = $request->file('image')
                    ->store('offers', 'public');

                $data['image'] = $imagePath;

                CompressOfferImage::dispatch($imagePath);
            }


            /*
            |--------------------------------------------------------------------------
            | Update Offer
            |--------------------------------------------------------------------------
            */

            $offer->update($data);


            /*
            |--------------------------------------------------------------------------
            | Update Product Units
            |--------------------------------------------------------------------------
            */

            if ($request->has('products')) {

                $productUnitIds = [];

                foreach ($request->products as $product) {

                    $productUnit = ProductUnit::where(
                        'product_id',
                        $product['product_id']
                    )
                        ->where(
                            'unit_id',
                            $product['unit_id']
                        )
                        ->first();

                    if (!$productUnit) {

                        throw new \Exception(
                            __('offer.invalid_product_unit')
                        );
                    }

                    $productUnitIds[] = $productUnit->id;
                }

                $offer->productUnits()->sync($productUnitIds);
            }


            DB::commit();

            return response()->json([

                'message' => __('offer.updated'),

                'data' => new OfferResource(

                    $offer->fresh()->load([
                        'productUnits.product',
                        'productUnits.unit',
                        'giftProductUnit.product',
                        'giftProductUnit.unit',
                    ])

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
     * Remove the specified offer.
     */
    public function destroy($id)
    {
        try {

            $offer = Offer::findOrFail($id);

            if ($offer->image) {

                Storage::disk('public')
                    ->delete($offer->image);
            }

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
