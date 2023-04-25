<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\ProductCountryPrice;
use App\Models\ProductTranslation;
use Livewire\Component;

class PriceForm extends Component
{
    public Product $product;
    public $lang;
    public ProductCountryPrice $productCountryPrice;

    public function rules() {
        return ['productCountryPrice.price' => ['required', 'integer', 'max:15000']];
    }

    public function mount(Product $product,
        $lang,
        ProductCountryPrice $productCountryPrice
    )
    {
        $this->product = $product;
        $this->lang = $lang;
        $this->productCountryPrice = $productCountryPrice;
    }

    public function create()
    {
        $data = $this->validate();

        $this->product->countryPrices()->create([
            'locale' => $this->lang,
            'price' => $data['productCountryPrice']['price']
        ]);

        redirect()->route('admin.products.edit', ['product' => $this->product]);
    }

    public function update()
    {
        $data = $this->validate();

        $this->product->localPrice($this->lang)->update($data['productCountryPrice']);

        redirect()->route('admin.products.edit', ['product' => $this->product]);
    }

    public function delete()
    {
        $this->product->localPrice($this->lang)->delete();

        redirect()->route('admin.products.edit', ['product' => $this->product]);
    }

    public function render()
    {
        return view('livewire.admin.product.price-form');
    }
}
