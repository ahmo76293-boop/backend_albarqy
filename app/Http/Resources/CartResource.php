<?php

namespace App\Http\Resources;

use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        $productUnit = ProductUnit::where('product_id', $this->product_id)
            ->where('unit_id', $this->unit_id)
            ->first();


        $originalPrice = $productUnit?->price ?? 0;


        $price = $originalPrice;


        $discount = 0;


        if ($productUnit) {

            $offer = $productUnit->activeOffer();


            if ($offer) {


                if ($offer->type === 'percentage') {

                    $discount = ($originalPrice * $offer->value) / 100;
                }


                if ($offer->type === 'fixed') {

                    $discount = $offer->value;
                }


                if ($discount > $originalPrice) {
                    $discount = $originalPrice;
                }


                $price = $originalPrice - $discount;
            }
        }



        return [

            'id' => $this->id,


            'product' => new ProductResource(
                $this->whenLoaded('product')
            ),


            'unit' => new UnitResource(
                $this->whenLoaded('unit')
            ),


            'quantity' => $this->quantity,


            'original_price' => (float) $originalPrice,


            'discount' => (float) $discount,


            'new_price' => (float) $price,


            'total' => (float) ($price * $this->quantity),


            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),


            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),

        ];
    }
}
