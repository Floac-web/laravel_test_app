<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ref'
    ];

    const COUNT = 8620;

    const PER_PAGE = 300;

    protected $guarded = [];

    public function wareHouses()
    {
        return $this->hasMany(CityWarehouse::class, 'city_ref', 'ref');
    }
}
