<?php

namespace App\Models;

use App\Support\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    protected $fillable = [
        'name_en',
        'name_ar',
        'unique_number',
        'barcode',
        'description_en',
        'description_ar',
        'status',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    public function units()
    {
        return $this->belongsToMany(Unit::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
