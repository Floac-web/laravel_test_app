@extends('layouts.app')

@section('content')

<form action="{{ route('admin.statistics.index') }}" method="get">

<div>
    <label for="from">Day Ago</label>
    <input type="date" name="from" min="0" max="300" value="{{ request()->from }}" step="1">
</div>
<div>
    <label for="to">To</label>
    <input type="date" name="to" min="0" max="11" value="{{ request()->to }}" step="1">
</div>

<button>get for period</button>
</form>

<table class="table" >
    <tr>
        <th>id</th>
        <th>name</th>
        <th>count</th>
    </tr>
    @foreach ($prds as $prd)
        <tr>
            <td>{{ $prd->product_id }}</td>
            <td>{{ $prd->product->title }}</td>
            <td>{{ $prd->total }}</td>
        </tr>
    @endforeach

</table>
@endsection
