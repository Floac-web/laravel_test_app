<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BasketItem extends Component
{
    public $userProduct;

    public function mount($userProduct)
    {
        $this->userProduct = $userProduct;
    }

    public function increment()
    {
        $this->userProduct->increment('quantity', 1);
    }

    public function decrement()
    {
        $this->userProduct->decrement('quantity', 1);

        if ($this->userProduct->quantity <= 0) {
            $this->remove();
        }
    }

    public function remove()
    {
        $this->userProduct->delete();

        $this->emitUp('refreshParentComponent');
    }

    public function render()
    {
        return view('livewire.basket-item');
    }
}
