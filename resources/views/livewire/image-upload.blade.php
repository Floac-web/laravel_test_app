<div>
    <form wire:submit.prevent="save">
        <input type="file" wire:model="photos" multiple>

        @error('photos.*')
            <span class="error">{{ $message }}</span>
        @else
            <ul wire:sortable="reorder" class="d-flex flex-wrap">
                @foreach ($photos as $key => $photo)
                    <li wire:sortable.item="{{ $key }}" wire:key="task-{{ $photo?->temporaryUrl() }}" class='m-2' style="width: 250px; height: 120px;  overflow:hidden;">
                        <img style="width: 250px; heidth: 120px;" src="{{ $photo?->temporaryUrl() }}" wire:sortable.handle>
                    </li>
                @endforeach
            </ul>
        @enderror

        <button class='btn btn-success' type="submit">Save Photo</button>
    </form>
</div>
