<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'city_id',
        'city_warehouse_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function cityWarehouse()
    {
        return $this->belongsTo(CityWarehouse::class);
    }
}
