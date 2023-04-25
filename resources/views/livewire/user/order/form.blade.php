<div>
    <div>
        @livewire('user.order.city-search')
    <div>

    </div>
        @if (isset($city))
            @livewire('user.order.warehouses-search', compact('city'))
        @endif
    </div>

    @if (isset($city) && isset($warehouse))
        <form action="{{ route('user.orders.store', [$city, $warehouse]) }}" method="POST">
            @csrf
            <div>
                <button>
                    order
                </button>
            </div>
        </form>
    @endif
</div>









