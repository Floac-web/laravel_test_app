<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class Photos extends Component
{
    use WithFileUploads;

    public $product;

    public $photos = [];

    public $uploadedPhotos = [];

    protected $listeners = [

    ];

    public function mount(Product $product)
    {
        $this->product = $product;

        $this->photos = $this->product->photos;
    }

    public function reorder($orderedIds)
    {
        $this->photos = collect($orderedIds)->map(function ($id) {
           return $this->product->photos->where('id', $id['value'])->first();
        });
    }

    public function deleteImg(ProductPhoto $photo)
    {
        Storage::disk($photo->disk)->delete($photo->path);

        $photo->delete();

        $this->photos = $this->product->photos()->get();
    }

    public function saveOrderes()
    {
        foreach($this->photos as $key => $orderedId) {
            $this->product->photos()->where('id', $orderedId['id'])->update([
                'order' => $key
            ]);
        }

        $this->photos = $this->product->photos()->get();
    }

    public function render()
    {
        return view('livewire.admin.product.photos');
    }
}
