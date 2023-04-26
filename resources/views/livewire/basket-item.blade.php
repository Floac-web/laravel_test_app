<div>
    {{ $basketProduct->product->countryPrices()->first()->price }}
     <div id="{{ $basketProduct->id }}">
        <a href="{{ route('products.show', $basketProduct->product) }}">
        <h4>{{ $basketProduct->product->translateOrDefault(app()->getLocale())->title }}</h4>
        </a>
        <strong>{{ $basketProduct->product->countryPrices()->first()->price * $basketProduct->quantity }}</strong>
        <div>
            <p>Count: {{ $basketProduct->quantity }}</p>
        </div>
        <div>{{$basketProduct->product->id}}</div>
        <button wire:click="increment">+</button>
        <button wire:click="decrement">-</button>
        <button wire:click="remove">remove</button>
    </div>
    <hr>
</div>
