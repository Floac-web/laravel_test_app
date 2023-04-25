@extends('layouts.app')

@section('content')
<div>
    <a href="{{ route('admin.categories.create') }}">Create Category</a><br>
    @foreach ($categories as $category)
    <div>
        <a href="{{ route('admin.categories.show', $category) }}">
        <h2>{{ $category->translateOrDefault(app()->getLocale())->name }}</h2>
        </a>
    </div>
            @foreach ($category->products as $product)
            <div>
                <a href="{{ route('admin.products.show', $product) }}"><h4>{{ $product->translateOrDefault(app()->getLocale())->title }}</h4></a>
                <div>
                    @foreach ($product->categories as $category)
                        <a href="{{ route('admin.categories.show', $category) }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a>
                    @endforeach
                </div>
                <p>
                    {{ $product->translateOrDefault(app()->getLocale())->description }}
                </p>
                {{-- <strong>{{ $product->price(app()->getLocale())->price }}</strong> --}}
            </div>
            <hr>
            @endforeach
    @endforeach
    {{ $categories->links() }}

@endsection
