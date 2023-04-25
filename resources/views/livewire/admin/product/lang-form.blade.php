<div>
    <p>Locale:  {{ $lang }}</p>
    <form wire:submit.prevent='{{ $product->hasTranslation($lang) ? "update" : "create" }}'>
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" wire:model="productTranslation.title">
            @error('productTranslation.title') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <input type="text" id="description" wire:model='productTranslation.description'>
            @error('productTranslation.description') <span style="color:red">{{ $message }}</span> @enderror
        </div>
        <button>
            {{ $product->hasTranslation($lang) ? "update" : "create" }}
        </button>
    </form>
    @if ($product->hasTranslation($lang) && $lang !== config('app.default_locale'))
        <button wire:click.prevent='delete'>delete Lang</button>
    @endif
</div>
