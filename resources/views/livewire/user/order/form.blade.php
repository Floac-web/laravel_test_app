<div>
    <div>
        @livewire('user.order.city-search')
        @error('city')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        @if (isset($city))
            @livewire('user.order.warehouses-search', compact('city'))
        @endif
    </div>

    <div>
        @if (isset($city) && isset($warehouse))
            @include('components.form.select', [
                'id' => 'paymentType',
                'label' => 'Payment Type',
                'model' => 'paymentType',
                'options' => ['cash', 'online']
            ])

            <button class="btn btn-success" wire:click.prevent="order">
                order
            </button>
        @endif
    </div>



</div>










