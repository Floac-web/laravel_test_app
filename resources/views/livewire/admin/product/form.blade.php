<div>
    @if($product->id)
        @livewire('admin.product.photos', compact('product'))
    @endif
    <form wire:submit.prevent='updateOrCreate'>
        @include('components.form.input', [
            'id' => 'status',
            'label' => 'Status',
            'model' => 'product.status',
        ])
        @include('components.form.select', [
            'model' => 'locale',
            'id' => 'locale',
            'label' => 'Locale',
            'options' => $supportLocales,
            'onChange' => 'changeLocale'
        ])
        @include('components.form.input', [
            'id' => 'title',
            'label' => 'Title',
            'model' => 'productTranslation.title',
        ])
        @include('components.form.input', [
            'id' => 'description',
            'label' => 'Description',
            'model' => 'productTranslation.description'
        ])
        @include('components.form.input', [
            'id' => 'price',
            'label' => 'Price',
            'model' => 'productCountryPrice.price',
        ])
        <div>
            <input type="file" wire:model.defer="photos" multiple>
            @error('photos.*', 'photos')
                <span class="error">{{ $message }}</span>
            @else
                <ul  class="d-flex flex-wrap">
                    @foreach ($photos as $photo)
                        <li class='m-2' style="width: 250px; height: 120px;  overflow:hidden;">
                            <img style="width: 250px; heidth: 120px;" src="{{ $photo?->temporaryUrl() }}" >
                        </li>
                    @endforeach
                </ul>
            @enderror
        </div>
        <button class="btn btn-success">
            {{ $product->id ? 'update' : 'create' }}
        </button>
    </form>
</div>
