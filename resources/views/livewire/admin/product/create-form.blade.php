<div>
    <div>
        <form wire:submit.prevent='create'>
            <div>
                locale: {{ config('app.default_locale') }}
            </div>
            <div>
                <label for="status">Status</label>
                <input type="text" id="status" wire:model='product.status'>
                @error('product.status') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" wire:model='productTranslation.title'>
                @error('productTranslation.title') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" id="description" wire:model='productTranslation.description'>
                @error('productTranslation.description') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="price">Local Price</label>
                <input type="text" id="price" wire:model='productCountryPrice.price'>
                @error('productCountryPrice.price') <span style="color:red">{{ $message }}</span> @enderror
            </div>
            <button>create</button>
        </form>
    </div>
</div>
