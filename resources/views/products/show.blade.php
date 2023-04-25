@extends('layouts.app')

@section('content')
<div>

    <div>
        <h4>{{ $product->translateOrDefault(app()->getLocale())->title }}</h4>
        <div>
            @foreach ($product->activeCategories as $category)
                <a href="{{ route('categories.show', $category) }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a>
            @endforeach
        </div>
        <p>
            {{ $product->translateOrDefault(app()->getLocale())->description }}
        </p>
        <strong>{{ $product->countryPrices[0]->price }}</strong>
    </div>
    <hr>

</div>
@endsection
