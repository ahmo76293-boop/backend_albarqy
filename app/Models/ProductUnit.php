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
        return $this->hasMany(
            Offer::class,
            'product_unit_id'
        );
    }


    public function activeOffer()
    {
        return $this->offers()
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->first();
    }

    public function getFinalPrice(): array
    {
        $originalPrice = (float) $this->price;

        $discount = 0;

        $offer = $this->activeOffer();

        if ($offer) {

            if ($offer->type === 'percentage') {
                $discount = ($originalPrice * $offer->value) / 100;
            } elseif ($offer->type === 'fixed') {
                $discount = $offer->value;
            }

            if ($discount > $originalPrice) {
                $discount = $originalPrice;
            }
        }

        return [
            'original_price' => $originalPrice,
            'discount' => $discount,
            'final_price' => $originalPrice - $discount,
        ];
    }
}
