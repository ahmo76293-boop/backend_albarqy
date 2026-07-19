<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $productUnit = $this->product
            ->units()
            ->where('unit_id', $this->unit_id)
            ->first();

        $price = $productUnit?->pivot?->price ?? 0;

        return [

            'id' => $this->id,

            'product' => new ProductResource(
                $this->whenLoaded('product')
            ),

            'unit' => new UnitResource(
                $this->whenLoaded('unit')
            ),

            'quantity' => $this->quantity,

            'price' => (float) $price,

            'total' => (float) ($price * $this->quantity),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
