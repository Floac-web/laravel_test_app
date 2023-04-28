<div>
    <div>
        @livewire('user.order.city-search')
    <div>

    </div>
        @if (isset($city))
            @livewire('user.order.warehouses-search', compact('city'))
        @endif
    </div>

    @if (isset($city) && isset($cityWarehouse))
        <form wire:submit.prevent="order">
            <div>
                <input type="text" wire:model='paymentType'>
                @error('paymentType') <span style="color:red">{{ $message }}</span> @enderror
                <button>
                    order
                </button>
            </div>
        </form>
    @endif
</div>









