<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'basket_id',
        'product_id',
        'quantity',
        'total'
    ];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
