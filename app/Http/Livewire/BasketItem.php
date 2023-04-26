<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BasketItem extends Component
{
    public $basket;

    public $basketProduct;

    public function mount($basketProduct, $basket)
    {
        $this->basketProduct = $basketProduct;

        $this->basket = $basket;
    }

    private function updateBasketTotal()
    {
        $this->basket->total = $this->basket->basketProducts()
        ->selectRaw('SUM(total) AS basket_total')
        ->first()->basket_total;

        $this->basket->save();
    }

    public function increment()
    {
        $this->basketProduct->increment('quantity', 1);

        $productPrice = $this->basketProduct->product->defaultPrice()->first()->price;

        $this->basketProduct->total = $productPrice * $this->basketProduct->quantity;

        $this->basketProduct->save();

        $this->updateBasketTotal();
    }

    public function decrement()
    {
        $this->basketProduct->decrement('quantity', 1);

        if ($this->basketProduct->quantity <= 0) {
            $this->remove();
        }

        $productPrice = $this->basketProduct->product->defaultPrice()->first()->price;

        $this->basketProduct->total = $productPrice * $this->basketProduct->quantity;

        $this->basketProduct->save();

        $this->updateBasketTotal();
    }

    public function remove()
    {
        $this->basketProduct->delete();

        $this->updateBasketTotal();

        $this->emitUp('refreshParentComponent');
    }

    public function render()
    {
        return view('livewire.basket-item');
    }
}
