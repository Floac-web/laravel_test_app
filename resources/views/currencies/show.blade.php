@extends('layouts.app')

@section('content')
<table class="table">
    <tr>
        <th>Rate</th>
        <th>Buy</th>
        <th>Sell</th>
    </tr>

    @foreach ($rates as $rate)
        <tr>
            <td>{{ "{$rate->fromCurrency->code} ({$rate->fromCurrency->symbol})" }} - {{ "{$rate->toCurrency->code} ({$rate->toCurrency->symbol})" }}</td>
            <td>{{ $rate->buy }}</td>
            <td>{{ $rate->sell }}</td>
        </tr>
    @endforeach
</table>
<form action="{{ route('currencies.update') }}" method="post">
    @csrf
    <button>reload</button>
    </form>
@endsection
