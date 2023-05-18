<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order',
        'path',
        'url',
        'disk',
    ];


    protected function url(): Attribute
    {
        return new Attribute(
            get: fn () => Storage::disk($this->disk)->url($this->path),
        );
    }
}
