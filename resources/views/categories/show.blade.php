@extends('layouts.app')

@section('content')
<div>

    <div>
        <a href="{{ route('categories.show', $category) }}">
        <h4>{{ $category->translateOrDefault(app()->getLocale())->name }}</h4>
        </a>
        <div>
            @foreach ($category->products as $product)
            <div>
                <div>
                    <a href="{{ route('products.show', $product) }}">
                        <h4>{{ $product->translateOrDefault(app()->getLocale())->title }}</h4>
                    </a>
                </div>
                <div>
                    @foreach ($product->categories->where('status', 'active') as $category)
                        <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
                <p>
                    {{ $product->translateOrDefault(app()->getLocale())->description }}
                </p>
                <strong>{{ $product->price(app()->getLocale())->price }}</strong>
            </div>
            <hr>
            @endforeach
        </div>

    </div>
@endsection
