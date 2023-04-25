<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\ProductTranslation;
use Livewire\Component;

class LangForm extends Component
{
    public Product $product;
    public $lang;
    public ProductTranslation $productTranslation;

    protected function rules()
    {
        return [
        'productTranslation.title' => ['required', 'string', 'min:5', 'max:190'],
        'productTranslation.description' => ['required', 'string', 'min:8', 'max:15000'],
        ];
    }

    public function mount(Product $product,
        $lang,
        ProductTranslation $productTranslation
    )
    {
        $this->product = $product;
        $this->lang = $lang;
        $this->productTranslation = $productTranslation;
    }

    public function create()
    {
        $data = $this->validate();

        // $this->product->translations()->create([
        //     'locale' => $this->lang,
        //     'title' => $data['productTranslation']['title'],
        //     'description' => $data['productTranslation']['description']
        // ]);


        $this->product->update([
            $this->lang => [
                'title' => $data['productTranslation']['title'],
                'description' => $data['productTranslation']['description'],
            ],
        ]);

        redirect()->route('admin.products.edit', ['product' => $this->product]);
    }

    public function update()
    {
        $data = $this->validate();

        $this->product->translations()->where('locale', $this->lang)->update([
            'title' => $data['productTranslation']['title'],
            'description' => $data['productTranslation']['description']
        ]);

        redirect()->route('admin.products.edit', ['product' => $this->product]);
    }

    public function delete()
    {
        $this->product->translations()->where('locale', $this->lang)->delete();

        redirect()->route('admin.products.edit', ['product' => $this->product]);
    }

    public function render()
    {
        return view('livewire.admin.product.lang-form');
    }
}
