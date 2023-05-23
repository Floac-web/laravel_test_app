<?php

namespace App\Models;

use App\Enums\OrderPaySystemEnum;
use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status',
        'user_id',
        'api',
        'total'
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class
    ];

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function scopeWaitingOnlinePay($query)
    {
        $query->whereStatus(OrderStatusEnum::Wait)->whereHas('orderPayments', function ($query) {
            $query->whereSystem(OrderPaySystemEnum::Online);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class)->with('product');
    }

    public function orderPayments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function orderPayment()
    {
        return $this->hasOne(OrderPayment::class);
    }

    public function orderAddress()
    {
        return $this->hasMany(OrderAddress::class);
    }
}
