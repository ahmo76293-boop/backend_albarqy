<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,

            'unique_number' => $this->unique_number,

            'barcode' => $this->barcode,

            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,

            'status' => (bool) $this->status,

            'category' => new CategoryResource(
                $this->whenLoaded('category')
            ),

            'images' => ProductImageResource::collection(
                $this->whenLoaded('images')
            ),

            'units' => $this->whenLoaded(
                'productUnits',
                function () {

                    return $this->productUnits->map(
                        function ($productUnit) {

                            $priceData = $productUnit->getFinalPrice();

                            $offer = $productUnit->offers
                                ->where('is_active', true)
                                ->filter(function ($offer) {

                                    return $offer->start_date <= now()
                                        && $offer->end_date >= now();
                                })
                                ->sortByDesc('id')
                                ->first();

                            $data = [

                                'id' => $productUnit->unit_id,

                                'name_en' => $productUnit->unit->name_en,

                                'name_ar' => $productUnit->unit->name_ar,

                                'quantity' => $productUnit->quantity,

                                'price' => (float) $productUnit->price,

                            ];

                            /*
                            |--------------------------------------------------------------------------
                            | Normal discount offer
                            |--------------------------------------------------------------------------
                            */

                            if (
                                $offer &&
                                in_array(
                                    $offer->type,
                                    ['fixed', 'percentage']
                                )
                            ) {

                                $data['original_price'] =
                                    (float) $priceData['original_price'];

                                $data['discount'] =
                                    (float) $priceData['discount'];

                                $data['final_price'] =
                                    (float) $priceData['final_price'];

                                $data['offer'] = [

                                    'id' => $offer->id,

                                    'title_en' => $offer->title_en,

                                    'title_ar' => $offer->title_ar,

                                    'description_en' =>
                                    $offer->description_en,

                                    'description_ar' =>
                                    $offer->description_ar,

                                    'type' => $offer->type,

                                    'value' => (float) $offer->value,

                                    'start_date' =>
                                    $offer->start_date?->format('Y-m-d'),

                                    'end_date' =>
                                    $offer->end_date?->format('Y-m-d'),

                                ];
                            }

                            /*
                            |--------------------------------------------------------------------------
                            | Gift offer
                            |--------------------------------------------------------------------------
                            */

                            if (
                                $offer &&
                                $offer->type === 'gift'
                            ) {

                                $data['offer'] = [

                                    'id' => $offer->id,

                                    'title_en' => $offer->title_en,

                                    'title_ar' => $offer->title_ar,

                                    'description_en' =>
                                    $offer->description_en,

                                    'description_ar' =>
                                    $offer->description_ar,

                                    'type' => 'gift',

                                    'buy_quantity' =>
                                    $offer->buy_quantity,

                                    'gift_quantity' =>
                                    $offer->gift_quantity,

                                    'gift_product' => $offer->giftProductUnit
                                        ? [

                                            'product_id' =>
                                            $offer->giftProductUnit->product_id,

                                            'unit_id' =>
                                            $offer->giftProductUnit->unit_id,

                                            'product_name_en' =>
                                            $offer->giftProductUnit->product->name_en,

                                            'product_name_ar' =>
                                            $offer->giftProductUnit->product->name_ar,

                                            'unit_name_en' =>
                                            $offer->giftProductUnit->unit->name_en,

                                            'unit_name_ar' =>
                                            $offer->giftProductUnit->unit->name_ar,

                                        ]
                                        : null,

                                    'start_date' =>
                                    $offer->start_date?->format('Y-m-d'),

                                    'end_date' =>
                                    $offer->end_date?->format('Y-m-d'),

                                ];
                            }

                            return $data;
                        }
                    );
                }
            ),

            'created_at' =>
            $this->created_at?->format('Y-m-d H:i:s'),

            'updated_at' =>
            $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
