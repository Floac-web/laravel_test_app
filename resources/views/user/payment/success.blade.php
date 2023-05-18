@extends('layouts.app')
@section('content')



<h1 class="text-success">Payment Succsess</h1>
<p>
    Order status: {{ $order->status }}
</p>
<table class="table">
    <thead>
        <th>currency</th>
        <th>amount</th>
        <th>status</th>
        <th>system</th>
    </thead>
    <tr>
        <td>{{ $order->orderPayments[0]->currency }}</td>
        <td>{{ $order->orderPayments[0]->amount }}</td>
        <td>{{ $order->orderPayments[0]->status }}</td>
        <td>{{ $order->orderPayments[0]->system }}</td>
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
        'quantity' => $orderProduct->quantity,
        'total' => $orderProduct->total,
        'product' => $orderProduct->product
    ])

@endforeach
</table>


<table class="table">
    <tr>
        <td>
            City
        </td>
        <td>
            {{ $order->orderAddress[0]->city->name }}
        </td>
    </tr>
    <tr>
        <td>
            Warehouse
        </td>
        <td>
            {{ $order->orderAddress[0]->cityWarehouse->address }}
        </td>
    </tr>
</table>
@endsection
