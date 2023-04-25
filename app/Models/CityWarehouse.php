<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityWarehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city_ref',
        'number'
    ];

    const COUNT = 23043;

    const PER_PAGE = 300;
}
