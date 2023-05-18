<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'quantity'
    ];

    public function basketProducts()
    {
        return $this->hasMany(BasketProduct::class)->with('product');
    }

    public function basketProduct($productId)
    {
        return $this->hasOne(BasketProduct::class)->where('product_id', $productId);
    }
}
