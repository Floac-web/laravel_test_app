<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Services\BasketService;
use Livewire\Component;

class Item extends Component
{
    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToBusket(BasketService $service)
    {
        $service->update($this->product);
    }

    public function render()
    {
        return view('livewire.admin.product.item');
    }
}
