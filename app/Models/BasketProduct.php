<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Casts\Attribute;

class BasketProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'basket_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->product->price,
        );
    }

    protected function sum(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price * $this->quantity,
        );
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price * $this->quantity,
        );
    }

}
