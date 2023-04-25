<div>
    {{ $userProduct->product->countryPrices()->first()->price }}
     <div id="{{ $userProduct->id }}">
        <a href="{{ route('products.show', $userProduct->product) }}">
        <h4>{{ $userProduct->product->translateOrDefault(app()->getLocale())->title }}</h4>
        </a>
        <strong>{{ $userProduct->product->countryPrices()->first()->price * $userProduct->quantity }}</strong>
        <div>
            <p>Count: {{ $userProduct->quantity }}</p>
        </div>
        <div>{{$userProduct->product->id}}</div>
        <button wire:click="increment">+</button>
        <button wire:click="decrement">-</button>
        <button wire:click="remove">remove</button>
    </div>
    <hr>
</div>
