
<div class="card">
    <img src="{{ $product->mainPhoto->url ?? '' }}" class="card-img-top" alt="...">
    <ul class="d-flex flex-wrap">
        @foreach ($product->photos as $photo)
            <li wire:key="{{ $photo->id }}" class='m-2' style="width: 250px; height: 120px;  overflow:hidden;">
                <img style="width: 250px; heidth: 120px;" src="{{ $photo->url }}" >
            </li>
        @endforeach
    </ul>
    <div class="card-body d-flex flex-column justify-content-between">
        <h5 class="card-title">
            <a href="{{ route('admin.products.show', $product) }}">
                {{ $product->translateOrDefault(app()->getLocale())->title ?? '' }}
            </a>
        </h5>
        <div>
            <p>
                {{ $product->translation->description }}
            </p>
        </div>
        <div>
            @foreach ($product->categories as $category)
                <a href="{{ route('admin.categories.show', $category) }}">
                    {{ $category->translateOrDefault(app()->getLocale())->name }}
                </a>
            @endforeach
        </div>
        <div>
        <p>
            <strong>
                {{ $product->price}}
            </strong>
                {{ $product->currency }}
        </p>
        </div>
    <div>

        <button class="btn btn-primary" wire:click="addToBusket">add to basket</button>
        @if (auth()->user()->role === 'admin')
            <a class="btn btn-secondary" href="{{ route('admin.products.edit', $product) }}">
                Edit
            </a>
        @endif


    </div>
    </div>
</div>
