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

            'units' => $this->whenLoaded('units', function () {
                return $this->units->map(function ($unit) {

                    return [
                        'id' => $unit->id,

                        'name_en' => $unit->name_en,
                        'name_ar' => $unit->name_ar,

                        'quantity' => $unit->pivot->quantity,
                    ];
                });
            }),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
