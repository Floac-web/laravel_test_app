<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    const STATUS_HIDE = 'hide';

    protected $perPage = 5;

    protected $fillable = [
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

    public function localPrice($locale)
    {
        return $this->countryPrices()->where('locale', $locale);
    }

    public function countryPrice()
    {
        return $this->countryPrices()->whereLocale(app()->getLocale());
    }

    public function defaultPrice()
    {
        return $this->countryPrices()->whereLocale(config('app.default_locale'));
    }

    public function translates()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public static function getActive()
    {
        return Product::whereStatus('active')
            ->whereHas('categories', function ($query) {
                $query->where('status', 'active');
            })
            ->with('activeCategories');
    }
}
