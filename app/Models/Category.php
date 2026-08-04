<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected  $fillable = [
        'name_en',
        'name_ar',
        'slug',
        'description_en',
        'description_ar',
        'image',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
