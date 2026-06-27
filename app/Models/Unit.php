<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'symbol',
        'status',
    ];
}
