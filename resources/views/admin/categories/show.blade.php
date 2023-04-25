@extends('layouts.app')

@section('content')
<div>

    <div>
        <a href="{{ route('admin.categories.show', $category) }}">
        <h4>{{ $category->translateOrDefault(app()->getLocale())->name }}</h4>
        </a>
        <a href="{{ route('admin.categories.edit', $category) }}">
            Edit category
        </a>
        <div>
            @foreach ($category->products as $product)
            <div>
                <div>
                    <a href="{{ route('admin.products.show', $product) }}">
                        <h4>{{ $product->translateOrDefault(app()->getLocale())->title }}</h4>
                    </a>
                </div>
                <div>
                    @foreach ($product->categories as $category)
                        <a href="{{ route('admin.categories.show', $category) }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a>
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
