
<div class="card">
    <img src="{{ $product->mainPhoto->url ?? '' }}" class="card-img-top" alt="...">
    <div class="card-body d-flex flex-column justify-content-between">
        <h5 class="card-title">
            <a href="{{ route('admin.products.show', $product) }}">
                {{ $product->translateOrDefault(app()->getLocale())->title ?? '' }}
            </a>
        </h5>
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
        @auth
            @if (auth()->user()->role === 'admin')
                <a class="btn btn-secondary" href="{{ route('admin.products.edit', $product) }}">
                    Edit
                </a>
            @endif
        @endauth
    </div>
    </div>
</div>
