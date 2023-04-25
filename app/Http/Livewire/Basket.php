<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Basket extends Component
{
    public $userProducts;

    protected $listeners = ['refreshParentComponent' => '$refresh'];

    public function mount()
    {
        $this->userProducts = auth()->user()->basketProducts()->get();
    }

    public function render()
    {
        return view('livewire.basket');
    }
}
