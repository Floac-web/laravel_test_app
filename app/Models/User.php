<?php

namespace App\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        $uuid = Str::uuid()->toString();

        parent::boot();

        self::creating(function ($model) use ($uuid) {
            $model->id = $uuid;
        });

        self::created(function ($model) use ($uuid) {
            Basket::updateOrCreate(
                ['session_id' => session('_token')],
                ['user_id' => $uuid]
            );
        });
    }

    public function basket()
    {
        return $this->hasOne(Basket::class)->with('basketProducts');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
