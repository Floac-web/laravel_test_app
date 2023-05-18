

<div class="mb-3 row">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">{{ $label }}</label>
    <div class="col-sm-10">
        <select
            class="form-select"
            id='{{ $id }}'
            wire:model="{{ $model }}"
            wire:change="{{ $onChange ?? '' }}"
            selected
            >
            @foreach ($options as $option)
                <option value="{{ $option }}" wire:key={{ $option }}>{{ $option }}</option>
            @endforeach
        </select>
    </div>
</div>
