<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [

        'user_id',

        'location_id',

        'order_number',

        'subtotal',

        'delivery_fee',

        'discount',

        'total',

        'payment_method',

        'payment_status',

        'status',

        'notes',

        'coupon_discount',

        'coupon_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
