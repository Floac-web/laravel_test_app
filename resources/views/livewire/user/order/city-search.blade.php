
<div x-data="{ showSearched: false }">
    @include('components.form.input', [
        'id' => 'city',
        'label' => 'City',
        'model' => 'value',
        'onFocus' => '$set("showSearched", "true")'
    ])

    @error('city')
        <span style="color:red">{{ $message }}
            {{ $message }}
        </span>
    @enderror

    @include('components.form.list', [
        'show' => $showSearched,
        'items' => $cities,
        'name' => 'name',
        'onClick' => 'setCity'
    ])
<div>
