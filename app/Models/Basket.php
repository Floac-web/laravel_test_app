<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quantity'
    ];

    public function basketProducts()
    {
        return $this->hasMany(BasketProduct::class)->with('product');
    }
}
