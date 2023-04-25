@extends('layouts.app')

@section('content')
<div>
    @foreach ($categories as $category)
    <div>
        <a href="{{ route('categories.show', $category) }}">
        <h2>{{ $category->translateOrDefault(app()->getLocale())->name }}</h2>
        </a>
    </div>
            @foreach ($category->products as $product)
            <div>
                <a href="{{ route('products.show', $product) }}">
                    <h4>{{ $product->translateOrDefault(app()->getLocale())->title }}</h4>
                </a>
                <div>
                    @foreach ($product->categories->where('status', 'active') as $category)
                        <div>
                            <a href="{{ route('categories.show', $category) }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a>
                            {{  $category->status }}
                        </div>
                    @endforeach
                </div>
                <p>
                    {{ $product->translateOrDefault(app()->getLocale())->description }}
                </p>
                <strong>{{ $product->price(app()->getLocale())->price }}</strong>
            </div>
            <hr>
            @endforeach


    @endforeach
    {{ $categories->links() }}
@endsection
