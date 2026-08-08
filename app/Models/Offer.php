<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'image',
        'type',
        'value',
        'buy_quantity',
        'gift_product_unit_id',
        'gift_quantity',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'value' => 'decimal:2',
    ];

    public function productUnits()
    {
        return $this->belongsToMany(
            ProductUnit::class,
            'offer_product_unit'
        );
    }

    public function giftProductUnit()
    {
        return $this->belongsTo(
            ProductUnit::class,
            'gift_product_unit_id'
        );
    }
}
