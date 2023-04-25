<div>
    <p>Locale:  {{ $lang }}</p>
    <form wire:submit.prevent='{{ $product->localPrice($this->lang)->first() ? "update" : "create" }}'>
        <div>
            <label for="price">Price</label>
            <input type="text" id="price" wire:model="productCountryPrice.price">
            @error('productCountryPrice.price') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <button>
            {{ $product->localPrice($this->lang)->first() ? "update" : "create" }}
        </button>
    </form>
    @if ($product->localPrice($this->lang)->first() && $lang !== config('app.default_locale'))
        <button wire:click.prevent='delete'>delete locale</button>
    @endif
</div>
