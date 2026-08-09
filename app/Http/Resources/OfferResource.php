<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,

            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,

            'image' => $this->image
                ? asset('storage/' . $this->image)
                : null,

            'type' => $this->type,

            'value' => $this->type !== 'gift'
                ? (float) $this->value
                : null,

            /*
            |--------------------------------------------------------------------------
            | Products included in the offer
            |--------------------------------------------------------------------------
            */

            'product_units' => $this->whenLoaded(
                'productUnits',
                function () {
                    return $this->productUnits->map(function ($productUnit) {

                        $oldPrice = (float) $productUnit->price;
                        $price = $oldPrice;

                        // For fixed/percentage offers
                        if ($this->type === 'percentage') {

                            $discount = ($oldPrice * (float) $this->value) / 100;

                            $price = max(0, $oldPrice - $discount);
                        } elseif ($this->type === 'fixed') {

                            $price = max(
                                0,
                                $oldPrice - (float) $this->value
                            );
                        }

                        return [
                            'id' => $productUnit->id,

                            'product' => [
                                'id' => $productUnit->product->id,
                                'name_en' => $productUnit->product->name_en,
                                'name_ar' => $productUnit->product->name_ar,
                                'image' => $productUnit->product->images->first()?->image,
                            ],

                            'unit' => [
                                'id' => $productUnit->unit->id,
                                'name_en' => $productUnit->unit->name_en,
                                'name_ar' => $productUnit->unit->name_ar,
                                'quantity' => $productUnit->quantity,
                            ],

                            'old_price' => $oldPrice,

                            'price' => $price,
                        ];
                    });
                }
            ),

            /*
            |--------------------------------------------------------------------------
            | Gift information
            |--------------------------------------------------------------------------
            */

            'buy_quantity' => $this->type === 'gift'
                ? $this->buy_quantity
                : null,

            'gift' => $this->when(
                $this->type === 'gift' && $this->giftProductUnit,
                function () {

                    $gift = $this->giftProductUnit;

                    return [
                        'product_unit_id' => $gift->id,

                        'product' => [
                            'id' => $gift->product->id,
                            'name_en' => $gift->product->name_en,
                            'name_ar' => $gift->product->name_ar,
                        ],

                        'unit' => [
                            'id' => $gift->unit->id,
                            'name_en' => $gift->unit->name_en,
                            'name_ar' => $gift->unit->name_ar,
                            'quantity' => $gift->quantity,
                        ],

                        'quantity' => $this->gift_quantity,
                    ];
                }
            ),

            /*
            |--------------------------------------------------------------------------
            | Dates
            |--------------------------------------------------------------------------
            */

            'start_date' => $this->start_date?->format('Y-m-d'),

            'end_date' => $this->end_date?->format('Y-m-d'),

            'is_active' => (bool) $this->is_active,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
