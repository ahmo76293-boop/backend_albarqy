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
        $price = $this->productUnit->price;

        $discount = $this->type === 'percentage'
            ? ($price * $this->value / 100)
            : $this->value;

        $finalPrice = max(0, $price - $discount);

        return [

            'id' => $this->id,

            'product' => [
                'id' => $this->productUnit->product->id,
                'name_en' => $this->productUnit->product->name_en,
                'name_ar' => $this->productUnit->product->name_ar,
            ],

            'unit' => [
                'id' => $this->productUnit->unit->id,
                'name_en' => $this->productUnit->unit->name_en,
                'name_ar' => $this->productUnit->unit->name_ar,
                'quantity' => $this->productUnit->quantity,
            ],

            'original_price' => (float) $price,

            'type' => $this->type,

            'value' => (float) $this->value,

            'discount_amount' => round($discount, 2),

            'final_price' => round($finalPrice, 2),

            'start_date' => $this->start_date->format('Y-m-d'),

            'end_date' => $this->end_date->format('Y-m-d'),

            'is_active' => $this->is_active,

            'created_at' => $this->created_at->format('Y-m-d H:i:s'),

            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

        ];
    }
}
