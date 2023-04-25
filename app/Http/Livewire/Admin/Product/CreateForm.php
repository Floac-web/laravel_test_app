<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCountryPrice;
use App\Models\ProductTranslation;
use Livewire\Component;

class CreateForm extends Component
{
    public $categories;

    public Product $product;
    public ProductTranslation $productTranslation;
    public ProductCountryPrice $productCountryPrice;
    public Category $category;

    protected function rules()
    {
        return [
        'product.status' => ['required', 'string', 'in:active,hide'],
        'productTranslation.title' => ['required', 'string', 'min:6', 'max:10'],
        'productTranslation.description' => ['required', 'string', 'min:6', 'max:10'],
        'productCountryPrice.price' => ['required', 'integer', 'max:15000'],
        'category' => ['nullable', 'exists:categories,id']
        ];
    }


    public function mount(Product $product,
        ProductTranslation $productTranslation,
        ProductCountryPrice $productCountryPrice
    )
    {
        $this->product = $product;
        $this->productTranslation = $productTranslation;
        $this->productCountryPrice = $productCountryPrice;

        $this->categories = Category::get();
    }

    public function create()
    {
        $data = $this->validate();

        $product = Product::create($data['product']);

        $product->categories()->attach($data['category']);

        $product->translations()->create($data['productTranslation']);

        $product->localPrice(config('app.default_locale'))->create($data['productCountryPrice']);

        redirect()->route('admin.products.show', compact('product'));
    }
    public function render()
    {
        return view('livewire.admin.product.create-form');
    }
}
