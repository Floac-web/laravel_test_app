<?php

namespace App\Services;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class BasketService
{
    public function getToken(): Basket
    {
        if (auth()->check()) {
            return auth()->user()->basket()->first();
        }

        session()->get('cart_token');


        session()->put('cart_token', 'uniq token');

        return Basket::firstOrCreate([
            'session_id' => session('_token')
        ]);
    }


    public function update(Product $product, int $count = 1): void
    {
        $item = $this->getItem($product);
        if ($item) {
            $this->updateItem($item, $count);
        } else {
            $this->createItem($product, $count);
        }
    }

    public function updateItem(BasketProduct $product, int $count = 1): void
    {
        $product->update([
            'quantity' => $count,
        ]);
    }

    public function createItem(Product $product, int $count = 1): void
    {
        $this->getToken()->basketProducts()->create([
            'product_id' => $product->id,
            'quantity' => $count,
        ]);
    }

    public function remove(Product $product): void
    {
        $this->getToken()->basketProducts()->where('product_id', $product->id)->delete();

        $this->getToken()->unsetRelation('basketProducts');
    }


    public function getItems(): Collection
    {
        return $this->getToken()->basketProducts;
    }

    public function getItem(Product $product): BasketProduct|null
    {
        return $this->getToken()->basketProduct($product->id)->first();
    }


    public function sum(): float
    {
        return $this->getItems()->sum('sum');
    }

    public function count(): int
    {
        return $this->getItems()->sum('quantity');
    }
}
