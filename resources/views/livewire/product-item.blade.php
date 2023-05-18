{{-- <div>
    <div>
        <div>
            ProductId: {{ $product->id }}
        </div>
        <a href="{{ route('products.show', $product) }}">
        <h4>{{ $product->translateOrDefault(app()->getLocale())->title }}</h4>
        </a>
        <div>
            @foreach ($product->categories as $category)
                <div>
                    <a href="{{ route('categories.show', $category) }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a>
                    {{ $category->status }}
                </div>
            @endforeach
        </div>
        <p>
            {{ $product->translateOrDefault(app()->getLocale())->description }}
        </p>
        <strong>{{ $product->countryPrices[0]->price }}</strong>
            <button wire:click="addToBusket">add to basket</button>
    </div>
    <hr>
</div> --}}

@include('components.product.teaser')
