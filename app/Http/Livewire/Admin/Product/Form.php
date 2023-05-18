<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\ProductCountryPrice;
use App\Models\ProductTranslation;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $locale;
    public $supportLocales;

    public $photos = [];

    public Product $product;
    public ProductTranslation $productTranslation;
    public ProductCountryPrice $productCountryPrice;

    protected function rules()
    {
        return [
            'product.status' => ['required', 'string', 'in:active,hide'],
            'productTranslation.title' => ['required', 'string', 'min:6', 'max:190'],
            'productTranslation.description' => ['required', 'string', 'min:6', 'max:1000'],
            'productCountryPrice.price' => ['required', 'integer', 'max:15000'],
            'photos' => ['nullable', 'array'],
            'photos.*' => ['required', 'image', 'max:1024'],
        ];
    }

    public function mount(
        Product $product,
        ProductTranslation $productTranslation,
        ProductCountryPrice $productCountryPrice,
    )
    {
        $this->locale = config('app.default_locale');
        $this->product = $product;
        $this->supportLocales = $product->id === null ? array(config('app.default_locale')) : config('app.support_langs');
        $this->productTranslation = $product->translations()->whereLocale($this->locale)->first() ?? $productTranslation;
        $this->productCountryPrice = $product->countryPrices()->whereLocale($this->locale)->first() ?? $productCountryPrice;
    }

    public function changeLocale(
        ProductTranslation $productTranslation,
        ProductCountryPrice $productCountryPrice
    )
    {
        $this->productTranslation = $this->product->translations()->whereLocale($this->locale)->first() ?? $productTranslation;
        $this->productCountryPrice = $this->product->countryPrices()->whereLocale($this->locale)->first() ?? $productCountryPrice;
    }

    public function updatedPhotos()
    {
        $this->validate([
            'photos' => ['nullable', 'array'],
            'photos.*' => ['required', 'image', 'max:1024'],
        ]);
    }

    public function addPhotos($photos, $product)
    {
        $photosCount = $product->photos()->count();

        foreach ($photos as $key => $photo) {
            $uploaded = $photo->store('public');

            $product->photos()->create([
                'order' => $key + $photosCount,
                'path' => $uploaded
            ]);
        }

        return true;
    }

    public function updateOrCreate()
    {
        $data = $this->validate();

        $product = $this->product->id ? $this->product : $this->product->create([
            'status' => $data['product']['status']
        ]);

        $product->update([
            $this->locale => [
                'title' => $data['productTranslation']['title'],
                'description' => $data['productTranslation']['description']
            ],
        ]);

        // $product->translations()->updateOrCreate(
        //     [
        //         'locale' => $this->locale
        //     ],
        //     [
        //         'title' => $data['productTranslation']['title'],
        //         'description' => $data['productTranslation']['description']
        //     ]
        // );

        $product->countryPrices()->updateOrCreate(
            [
                'locale' => $this->locale
            ],
            [
                'price' => $data['productCountryPrice']['price']
            ]
        );

        if (!empty($data['photos'])) {
            $this->addPhotos($data['photos'], $product);
        }

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.product.form');
    }
}
