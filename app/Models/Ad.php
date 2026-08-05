<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'image',
        'url',
        'is_active',
        'sort_order',
    ];
}
