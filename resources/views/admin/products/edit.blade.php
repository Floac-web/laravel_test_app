@extends('layouts.app')

@section('content')
<div>
    <hr>
    @foreach (localization()->getSupportedLocalesKeys() as $lang)
        <div>
            @if ($product->hasTranslation($lang))
                <div>
                    <a href="{{ route('admin.products.lang.update', compact('product', 'lang')) }}">edit</a>
                    <p>
                        locale: {{ $product->translate($lang)->locale }}
                    </p>
                    <h5>Title: {{ $product->translate($lang)->title }}</h5>
                    <p>
                        <strong>Description:  </strong> {{ $product->translate($lang)->description }}
                    </p>
                </div>
            @else
                <a href="{{ route('admin.products.lang.add', [$product, $lang]) }}">
                    add {{ $lang }} language
                </a>
            @endif
            <hr>
        </div>
    @endforeach
    @foreach (localization()->getSupportedLocalesKeys() as $lang)
        <div>
            @if (empty($product->countryPrices()->where('locale', $lang)->first()))
                <a href="{{ route('admin.products.price.add', [$product, $lang]) }}">create local price</a>
            @else
            <a href="{{ route('admin.products.price.update', compact('product', 'lang')) }}">update price</a>
                <p>
                    locale: {{ $lang }}
                </p>
                <p>
                    Price: {{ $product->countryPrices()->where('locale', $lang)->first()->price }}
                </p>
            @endif
        </div>
    @endforeach
</div>
@endsection
