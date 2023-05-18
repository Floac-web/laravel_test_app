<?php

namespace App\Http\Livewire;

use App\Models\BasketProduct;
use App\Models\Product;
use App\Services\BasketService;
use Livewire\Component;

class BasketItem extends Component
{
    public $basketProduct;

    protected $listeners = [
        'cart-refresh' => '$refresh',
    ];

    public function mount($basketProduct)
    {
        $this->basketProduct = $basketProduct;
    }

    public function remove(BasketService $service)
    {
        $service->remove($this->basketProduct->product);

        $this->emitUp('refreshParentComponent');
    }

    public function increment(BasketService $service)
    {
        $service->updateItem($this->basketProduct, $this->basketProduct->quantity + 1);

        $this->emitUp('refreshParentComponent');
    }

    public function decrement(BasketService $service)
    {
        if ($this->basketProduct->quantity > 1) {
            $service->updateItem($this->basketProduct, $this->basketProduct->quantity - 1);
        }
        $this->emitUp('refreshParentComponent');
    }

    public function render()
    {
        return view('livewire.basket-item');
    }
}
