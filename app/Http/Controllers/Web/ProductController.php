<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategories = $request->categories;

        $products = Product::whereHas('categories', function ($query) use ($selectedCategories) {
            if ($selectedCategories) {
                $query->whereIn('category_id', $selectedCategories);
            }
        })
            ->with('countryPrices')
            ->paginate(6)
            ->withQueryString();

        $categories = Category::get();

        return view('products.index', compact('products', 'categories', 'selectedCategories'));
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
