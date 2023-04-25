<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'updated_at',
        'buy',
        'cross',
        'sell'
    ];

    public $timestamps = false;

    public function fromCurrency()
    {
        return $this->belongsTo(Currency::class, 'from', 'number');
    }

    public function toCurrency()
    {
        return $this->belongsTo(Currency::class, 'to', 'number');
    }

}
