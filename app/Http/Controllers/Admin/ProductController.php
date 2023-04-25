<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function addLang(Product $product, $lang)
    {
        if ($product->hasTranslation($lang))
        {
            return redirect()->route('admin.products.lang.update', compact('product', 'lang'));
        }

        return view('admin.products.add-lang', compact('product', 'lang'));
    }

    public function updateLang(Product $product, $lang)
    {
        if (!$product->hasTranslation($lang))
        {
            return redirect()->route('admin.products.lang.add', compact('product', 'lang'));
        }

        $productTranslation = $product->translations()->whereLocale($lang)->first();

        return view('admin.products.update-lang', compact('product', 'lang', 'productTranslation'));
    }

    public function addPrice(Product $product, $lang)
    {
        $productCountryPrice = $product->countryPrices()->where('locale', $lang)->first();

        if ($productCountryPrice) {
            return redirect()->route('admin.products.price.update', compact('product', 'lang', 'productCountryPrice'));
        }


        return view('admin.products.add-price', compact('product', 'lang'));
    }

    public function updatePrice(Product $product, $lang, $productCountryPrice = null)
    {
        if (!$productCountryPrice) {
            $productCountryPrice = $product->countryPrices()->where('locale', $lang)->first();
        }

        if (!$productCountryPrice) {
            return redirect()->route('admin.products.price.add', compact('product', 'lang'));
        }

        return view('admin.products.update-price', compact('product', 'lang', 'productCountryPrice'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

}
