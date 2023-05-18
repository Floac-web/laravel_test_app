<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    const STATUS_HIDE = 'hide';

    protected $perPage = 5;

    protected $fillable = [
        'id',
        'prices'
    ];

    public $translatedAttributes = ['title', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class)->with('translates');
    }

    public function activeCategories()
    {
        return $this->categories()->where('status', 'active');
    }

    public function countryPrices()
    {
        return $this->hasMany(ProductCountryPrice::class);
    }


    public function countryPrice()
    {
        return $this->hasOne(ProductCountryPrice::class)->whereLocale(app()->getLocale());
    }

    public function defaultPrice()
    {
        return $this->hasOne(ProductCountryPrice::class)->whereLocale(config('app.default_locale'));
    }

    // public function countryPrice()
    // {
    //     return $this->countryPrices()->whereLocale(app()->getLocale());
    // }

    // public function defaultPrice()
    // {
    //     return $this->countryPrices()->whereLocale(config('app.default_locale'));
    // }

    public static function getActive()
    {
        return Product::whereStatus('active')->with('activeCategories');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class)->orderBy('order', 'asc');
    }

    public function mainPhoto()
    {
        return $this->hasOne(ProductPhoto::class)->where('order', 0);
    }


    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->countryPrice?->price ?? $this->defaultPrice?->price,
        );
    }

    protected function currency(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->countryPrice?->code ?? $this->defaultPrice?->code,
        );
    }
}
