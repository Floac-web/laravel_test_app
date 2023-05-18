<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class DeleteModal extends ModalComponent
{
    public Product $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function delete()
    {
        $this->product->delete();

        $this->closeModal();

        $this->emit('deleted');
    }

    public function render()
    {
        return view('livewire.admin.product.delete-modal');
    }
}
