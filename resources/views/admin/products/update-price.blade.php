@extends('layouts.app')

@section('content')
    @livewire('admin.product.price-form', compact('product', 'lang', 'productCountryPrice'))
@endsection
