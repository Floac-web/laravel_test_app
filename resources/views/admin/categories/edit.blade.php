@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.categories.update', $category) }}" method="post">
        @method('patch')
        @csrf
        @foreach (localization()->getSupportedLocalesKeys() as $lang)
        <div>
            <label for="{{$lang}}_name">{{$lang}} Name</label>
            <input type="text" name="langs[{{$lang}}][name]" id="{{$lang}}_name" value="{{old("_name", $category->translateOrDefault("$lang")->name)}}">
            @error('langs[{{$lang}}][name]')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    @endforeach
    <div>
        <label for="status">Status</label>
        <input type="checkbox" value="active" name='status' id="status">
    </div>
    <button>create category</button>
    </form>
@endsection
