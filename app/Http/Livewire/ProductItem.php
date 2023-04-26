<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductItem extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function addToBusket()
    {
        $basket = auth()->user()->basket;

        $basketProduct = $basket->BasketProducts()->whereProductId($this->product->id)
        ->first();

        if ($basketProduct) {
            $basketProduct->increment('quantity', 1);

        } else {
            $basket->BasketProducts()->create([
                'product_id' => $this->product->id,
                'quantity' => 1,
                'total' => $this->product->defaultPrice()->first()->price
            ]);
        }

        $basket->total = $basket->basketProducts()
        ->selectRaw('SUM(total) AS basket_total')
        ->first()->basket_total;

        $basket->save();
    }



    public function render()
    {
        return view('livewire.product-item');
    }
}
