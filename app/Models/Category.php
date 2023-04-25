<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    const STATUS_HIDE = 'hide';

    protected $fillable = [
        'status'
    ];

    protected $perPage = 5;

    public $translatedAttributes = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function activeProducts()
    {
        return $this->products()->where('status', 'active');
    }

    public function translates()
    {
        return $this->hasMany(CategoryTranslation::class)->whereLocale(app()->getLocale());
    }

    public static function getActive()
    {
        return Category::whereStatus('active')
            ->whereHas('products', function ($query) {
                $query->where('status', 'active');
            })
            ->with('activeProducts')
            ->paginate();
    }

}
