@extends('layouts.app')

@section('content')
<div>
    <div>
        <div>
            <strong>User: {{ $order->user->name }}</strong>
            <form action="{{ route('admin.orders.update', $order) }}" method="post">
                @csrf
                @method('patch')
                <label for="status"></label>
                <input type="text" name='status' id="status" value="{{ old('status', $order->status) }}">
                <button>update status</button>
                </form>
        </div>
        <div>
            <strong>Status: {{ $order->status }}</strong>
        </div>
        <h4>{{ $order->product->translateOrDefault(app()->getLocale())->title }}</h4>
        <div>
            @foreach ($order->product->categories as $category)
                <div>
                    <a href="{{ route('categories.show', $category) }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a>
                </div>
            @endforeach
        </div>
        <p>
            {{ $order->product->translateOrDefault(app()->getLocale())->description }}
        </p>
        <strong>Price: {{ $order->product->price($order->country)->price }}</strong>
        <div>
            <p>Count: {{ $order->quantity }}</p>
        </div>
        <div>
            <p>Total: {{ $order->total }}</p>
        </div>
    </div>
    <hr>
</div>

@endsection
