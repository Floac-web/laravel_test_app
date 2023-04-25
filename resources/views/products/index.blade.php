@extends('layouts.app')

@section('content')
<div>
    @foreach ($products as $product)
    {{-- <div>
        <div>
            ProductId: {{ $product->id }}
        </div>
        <a href="{{ route('products.show', $product) }}">
        <h4>{{ $product->translates[0]->title }}</h4>
        </a>
        <div>
            @foreach ($product->categories as $category)
                <div>
                    <a href="{{ route('categories.show', $category) }}">{{ $category->translates[0]->name }}</a>
                    {{ $category->status }}
                </div>
            @endforeach
        </div>
        <p>
            {{ $product->translates[0]->description }}
        </p>
        <strong>{{ $product->countryPrices[0]->price }}</strong>
        <form action="{{ route('user.basket.update', $product) }}" method="POST">
            @method('patch')
            @csrf
            <button name="quantity" value="1">add to basket</button>
        </form>
    </div>
    <hr> --}}
    @livewire('product-item', ['product' => $product])
    @endforeach
</div>
{{ $products->links() }}
@endsection
