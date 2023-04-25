@extends('layouts.app')

@section('content')
<div>
    @livewire('basket', ['userProducts' => $userProducts])
</div>
@endsection
