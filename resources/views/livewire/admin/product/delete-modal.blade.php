<div class="p-5">
    <p>
        видалити продукт
    </p>
    <div>
        <button class="btn btn-danger" wire:click='delete'>DELETE</button>
        <button class="btn btn-warning" wire:click="$emit('closeModal')">No, do not delete</button>
    </div>

</div>
