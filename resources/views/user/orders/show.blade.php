@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
        <th>status</th>
        <th>total</th>
        <th>currency</th>
        <th>system</th>
        <th>city</th>
        <th>warehouse</th>
    </thead>
    <tr>
        @include('components.order.row', [
            'status' => $order->status,
            'total' => $order->total,
            'currency' => $order->orderPayments[0]->currency ,
            'system' => $order->orderPayments[0]->system,
            'city' => $order->orderAddress[0]->city->name,
            'warehouse' => $order->orderAddress[0]->cityWarehouse->address
        ])
    </tr>
</table>

<table class="table">
    <thead>
        <th>title</th>
        <th>total</th>
        <th>quantity</th>
    </thead>
    @foreach ($order->orderProducts as $orderProduct)
        @include('components.product.row', [
            'product' => $orderProduct->product,
            'quantity' => $orderProduct->quantity,
            'total' => $orderProduct->total
        ])
    @endforeach
</table>

@endsection
