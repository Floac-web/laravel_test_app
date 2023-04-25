@extends('layouts.app')

@section('content')

<form action="{{ route('admin.statistics.update') }}" method="post">

    @csrf
<div>
    <label for="from">Day Ago</label>
    <input type="range" name="from" min="0" max="300" value="7" step="1">
</div>
<div>
    <label for="to">To</label>
    <input type="range" name="to" min="0" max="11" value="0" step="1">
</div>

<button>get for period</button>
</form>
@endsection
