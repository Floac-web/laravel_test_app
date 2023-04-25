@extends('layouts.app')

@section('content')
    @livewire('admin.product.lang-form', compact('product', 'lang', 'productTranslation'))
@endsection
