@extends('layouts.app')

@section('content')
<div>
    @foreach ($orders as $order)
    <div>
        <a href="{{ route('user.orders.show', $order) }}">
            <h1>
                Order
            </h1>
        </a>
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
                    'currency' => !$order->orderPayments->isEmpty() ? $order->orderPayments[0]->currency : null,
                    'system' => !$order->orderPayments->isEmpty() ? $order->orderPayments[0]->system : null,
                    'city' => !$order->orderPayments->isEmpty() ? $order->orderAddress[0]->city->name : null,
                    'warehouse' => !$order->orderPayments->isEmpty() ? $order->orderAddress[0]->cityWarehouse->address : null
                ])
            </tr>
        </table>
        <hr>
        @endforeach
    </div>

</div>
{{ $orders->links() }}
@endsection
