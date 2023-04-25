@extends('layouts.app')
@section('content')
<div>
    <div>
        <div>
            <strong>User: {{ $order->user->name }}</strong>
        </div>
        <div>
            <strong>Status: {{ $order->status }}</strong>
            <a href="{{ route('admin.orders.edit', $order) }}">Update Status</a>
        </div>
        <a href="{{ route('admin.products.show', $orderProduct->product) }}">
            <h4>{{ $orderProduct->product->translateOrDefault(app()->getLocale())->title }}</h4>
            </a>
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
    <div>
        <form action="{{ route('admin.orders.destroy', $order) }}" method="post">
        @csrf
        @method('delete')
        <button>delete order</button>
        </form>
    </div>
</div>

@endsection
