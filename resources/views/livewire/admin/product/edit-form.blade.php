<div>
    <div class="d-flex justify-content-between">
        <div class="p-5 w-50">
            <label for="photo">
            <div class="w-50 h-50 overflow-hidden">
                <img src="{{ $product->mainPhoto->url ?? '' }}" alt="main photo">
            </div>
            додати фото
             </label>
            <form wire:submit.prevent='addPhotos'>

            <input type="file" id="photo" wire:model.defer="photos" multiple class="d-none">
            @error('photos')
                <span class="error">{{ $message }}</span>
            @enderror
            @error('photos.*')
                <span class="error">{{ $message }}</span>
            @else
                <ul class="d-flex flex-wrap">
                    @foreach ($photos as $photo)
                        <li class='m-2' style="width: 250px; height: 120px;  overflow:hidden;">
                            <img style="width: 250px; heidth: 120px;" src="{{ $photo?->temporaryUrl() }}" >
                        </li>
                    @endforeach
                </ul>
            @enderror
            <button class="btn btn-success" class="w-50">зберегти фото</button>
            <a class='btn btn-primary' href="{{ route('admin.products.photos.index', compact('product')) }}">change photos orderers</a>
            </form>
        </div>
        <form wire:submit.prevent='update'>
            <div>
                @include('components.form.input', [
                    'label' => 'Status',
                    'model' => 'product.status',
                    'id' => 'status'
                ])
            </div>
            <div>
                @include('components.form.select', [
                    'model' => 'locale',
                    'id' => 'locale',
                    'label' => 'Locale',
                    'options' => config('app.support_langs'),
                    'onChange' => 'changeLocale'
                ])
            </div>
            <div>
                @include('components.form.input', [
                    'label' => 'Title',
                    'model' => 'productTranslation.title',
                    'id' => 'title'
                ])
            </div>
            <div>
                @include('components.form.input', [
                    'label' => 'Description',
                    'model' => 'productTranslation.description',
                    'id' => 'description'
                ])
            </div>
            <div>
                @include('components.form.input', [
                    'label' => "Local Price",
                    'model' => 'productCountryPrice.price',
                    'id' => 'price'
                ])
            </div>
            <button class='btn btn-success'>update</button>
        </form>

    </div>
</div>
