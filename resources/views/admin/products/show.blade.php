@extends('layouts.app')

@section('content')
{{--
<div>
    <div>
        <h4>{{ $product->translateOrDefault(app()->getLocale())->title }}</h4>
        <div>
            @foreach ($product->categories as $category)
                <a href="{{ route('admin.categories.show', $category) }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a>
            @endforeach
        </div>
        <p>
            {{ $product->translateOrDefault(app()->getLocale())->description }}
        </p>
        <strong>{{ $product->countryPrices[0]->price }}</strong>
    </div>
    <a class="btn btn-primary" href="{{ route('admin.products.edit', $product) }}">Edit</a>
    <hr>

</div> --}}
    @livewire('admin.product.item', compact('product'))
@endsection
