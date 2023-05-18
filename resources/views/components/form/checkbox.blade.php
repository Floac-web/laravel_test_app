<div>
    <input
        type="checkbox"
        class="btn-check"
        value='{{ $id  }}'
        name='{{ $name }}'
        id='{{ $id }}'
        autocomplete="off"
        {{ $isChecked }}
    >
    <label
        class="btn btn-outline-primary"
        for='{{ $id }}'
    >
        {{ $label }}
    </label>
</div>
