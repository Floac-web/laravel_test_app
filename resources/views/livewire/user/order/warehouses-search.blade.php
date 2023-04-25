<div>
   <label for="warehouse">Warehouse</label>
   <input type="text" id="warehouse" wire:model='value' wire:click="$set('showSearched', 'true')">

    @if ($showSearched)
        <form wire:submit.prevent="$set('showSearched', false)">
            <ul>
                <div>
                    {{ $value }}
                </div>
                @foreach ($warehouses as $warehouse)
                <li>
                    <button  wire:click.stop="setWarehouse({{ $warehouse }})">
                        {{ $warehouse->address }}
                    </button>
                </li>
                @endforeach
            </ul>
        </form>
    @endif
</div>
