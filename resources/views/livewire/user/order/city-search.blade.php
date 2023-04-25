<div>
   <label for="city">City</label>
   <input type="text" id="city" wire:model='value' wire:click="$set('showSearched', 'true')">

   @if ($showSearched)
        <form wire:submit.prevent="$set('showSearched', false)">
            <ul>
                <div>
                    {{ $value }}
                </div>
                @foreach ($cities as $city)
                <li>
                    <button  wire:click.stop="setCity({{ $city }})">
                        {{ $city->name }}
                    </button>
                </li>
                @endforeach
            </ul>
        </form>
    @endif
</div>
