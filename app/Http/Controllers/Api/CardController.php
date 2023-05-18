<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketProductRequest;
use App\Http\Requests\CountRequest;
use App\Http\Resources\BasketProductResource;
use App\Http\Resources\BasketResource;
use App\Models\Product;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $basket = basket()->getToken();

        return new BasketResource($basket);
    }

    public function add(Product $product)
    {
        basket()->update($product);

        return new BasketResource(basket()->getToken());
    }

    public function remove(Product $product)
    {
        basket()->remove($product);

        return new BasketResource(basket()->getToken());
    }

    public function update(Product $product, CountRequest $request)
    {
        $data = $request->validated();

        $basketProduct = basket()->getItem($product);

        basket()->updateItem($basketProduct, $data['count']);

        return new BasketResource(basket()->getToken());
    }
}
