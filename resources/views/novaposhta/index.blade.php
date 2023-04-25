@extends('layouts.app')

@section('content')
@foreach ($cities as $city)
<div>
{{ $city->name }}

    @foreach ($city->wareHouses as $wareHouse)
    <div>
        {{ $wareHouse->address }}
    </div>
    @endforeach

<hr>
</div>
@endforeach
{{ $cities->links() }}
@endsection

