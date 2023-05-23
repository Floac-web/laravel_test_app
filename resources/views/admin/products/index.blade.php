@extends('layouts.app')

@section('content')
    <div class="bg-white p-5 rounded mb-2 d-flex justify-content-between">
        <h4>Product list</h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">
            {{-- <i class="bi bi-plus"></i>   --}}
            Додати продукт
        </a>
    </div>
    @livewire('admin.product.index')
@endsection

