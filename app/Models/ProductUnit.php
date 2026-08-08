<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    protected $table = 'product_unit';


    protected $fillable = [
        'product_id',
        'unit_id',
        'quantity',
        'price',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }


    public function offers()
    {
        return $this->belongsToMany(
            Offer::class,
            'offer_product_unit',
            'product_unit_id',
            'offer_id'
        );
    }


    public function activeOffer()
    {
        return $this->offers()
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->first();
    }

    public function activeOffers()
    {
        return $this->offers()
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();
    }

    public function getFinalPrice(): array
    {
        $originalPrice = (float) $this->price;

        $discount = 0;

        $offer = $this->activeOffer();

        if ($offer) {

            if ($offer->type === 'percentage') {

                $discount = ($originalPrice * (float) $offer->value) / 100;
            } elseif ($offer->type === 'fixed') {

                $discount = (float) $offer->value;
            }

            // Gift offers don't reduce the price
            if ($offer->type === 'gift') {
                $discount = 0;
            }

            // Never allow discount to exceed the original price
            $discount = min($discount, $originalPrice);
        }

        return [
            'original_price' => round($originalPrice, 2),

            'discount' => round($discount, 2),

            'final_price' => round(
                $originalPrice - $discount,
                2
            ),

            'offer' => $offer,
        ];
    }

    public function giftOffers()
    {
        return $this->hasMany(
            Offer::class,
            'gift_product_unit_id'
        );
    }
}
