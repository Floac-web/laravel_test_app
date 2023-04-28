@extends('layouts.app')
@section('content')

<h1>Payment Succsess</h1>
{{ $orderPayment }}<br>
{{ $orderAddress->city->name }}<br>
{{ $orderAddress->cityWarehouse->address }}<br>
@endsection
