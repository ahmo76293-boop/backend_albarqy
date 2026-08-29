<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'type',
        'title_en',
        'title_ar',
        'value_en',
        'value_ar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
