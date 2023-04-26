<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::getActive();

        $products = Product::with('categories', 'countryPrices')->paginate(5);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        if ($product->status === Product::STATUS_HIDE) {
            abort(404);
        }

        $product->load('activeCategories');

        return view('products.show', compact('product'));
    }

}
