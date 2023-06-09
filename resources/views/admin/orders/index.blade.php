@extends('layouts.app')

@section('content')
<div>
    @foreach ($orders as $order)
    <div>
        <div>
            <a href="{{ route('admin.orders.users', $order->user) }}">User: {{ $order->user->name }}</a>
        </div>
        <a href="{{ route('user.orders.show', $order) }}">
            <h1>Order</h1>
        </a>
        <div>
            <strong>Status: {{ $order->status }}</strong>
        </div>
        <a href="{{ route('admin.orders.show', $order) }}">
            @foreach ($order->orderProducts as $orderProduct)
            <a href="{{ route('admin.products.show', $orderProduct->product) }}">
             <h4>{{ $orderProduct->product->translateOrDefault(app()->getLocale())->title }}</h4>
             </a>
             <div>
                 @foreach ($orderProduct->product->categories as $category)
                     <div>
                         <a href="{{ route('categories.show', $category) }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</a>
                     </div>
                 @endforeach
             </div>
             <p>
                 {{ $orderProduct->product->translateOrDefault(app()->getLocale())->description }}
             </p>
             <strong>Price: {{ $orderProduct->product->defaultPrice[0]->price }}</strong>
             <div>
                 <p>Count: {{ $orderProduct->quantity }}</p>
             </div>
             <div>
                 <p>Total: {{ $orderProduct->total }}</p>
             </div>
         @endforeach
         <form action="{{ route('admin.orders.destroy', $order) }}" method="post">
            @csrf
            @method('delete')
            <button>delete order</button>
        </form>
    <hr>
    @endforeach

</div>
{{ $orders->links() }}
@endsection
