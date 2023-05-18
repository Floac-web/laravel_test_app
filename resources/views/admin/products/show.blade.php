@extends('layouts.app')

@section('content')
<div class="bg-white p-5 rounded">
    @livewire('admin.product.item', compact('product'))
</div>
@endsection
