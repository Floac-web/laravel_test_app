<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Basket extends Component
{
    public $basketProducts;
    public $basket;

    protected $listeners = ['refreshParentComponent' => '$refresh'];

    public function mount()
    {
        $this->basket = auth()->user()->basket()->first();

        $this->basketProducts = $this->basket->BasketProducts;
    }

    public function render()
    {
        return view('livewire.basket');
    }
}
