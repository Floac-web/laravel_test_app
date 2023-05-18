@extends('layouts.app')
@section('content')

<h1>Payment Page</h1>
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
    <td></td>
    <td>{{ $order->total }}</td>
    <td></td>
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

<a class="btn btn-success" href="{{ $payUrl }}">Оплатити</a>
@endsection


