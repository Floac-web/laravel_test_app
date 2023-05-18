
<div class="mb-3 row">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">{{ $label }}</label>
    <div class="col-sm-10">
      <input
            type="text"
            class="form-control"
            id="{{ $id }}"
            wire:model.debounce.300ms="{{ $model }}"
            wire:focus='{{ $onFocus ?? '' }}'
        >
    </div>
    @error($model)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
