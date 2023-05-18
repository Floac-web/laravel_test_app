@extends('layouts.app')

@section('content')
<div>
    <form action="{{ route('products.index') }}" method="GET" class="mb-5">
        @csrf
        <div class="d-flex justify-content-between mb-3">
            @foreach ($categories as $category)
                @include('components.form.checkbox', [
                    'id' =>  $category->id,
                    'name' => "categories[]",
                    'label' => $category->translateOrDefault(app()->getLocale())->name,
                    'isChecked' => $selectedCategories && in_array($category->id, $selectedCategories) ? 'checked' : ''
                ])
            @endforeach
        </div>
        <button class="btn btn-success">
            filter
        </button>
    </form>
    <div class="row row-cols-1-md-3 row-cols-md-3 g-4">
        @foreach ($products as $product)
        @livewire('product-item', ['product' => $product])
        @endforeach
    </div>
</div>
{{ $products->links() }}
@endsection
