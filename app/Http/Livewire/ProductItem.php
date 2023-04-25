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
        $basketProduct = auth()->user()->basketProducts()
        ->whereProductId($this->product->id)
        ->first();

        if ($basketProduct) {
            $basketProduct->increment('quantity', 1);
        } else {
            auth()->user()->basketProducts()->create([
                'product_id' => $this->product->id,
                'quantity' => 1,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.product-item');
    }
}
