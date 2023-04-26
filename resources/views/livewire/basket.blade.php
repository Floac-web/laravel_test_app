<div>
    <a href="{{ route('user.orders.index') }}">orders</a>
    <hr>


        @if(isset($basketProducts) && $basketProducts->count() > 0)
            @foreach ($basketProducts as $basketProduct)
            @livewire('basket-item', compact('basketProduct', 'basket'), key($basketProduct->id))
            @endforeach
            @livewire('user.order.form') <br>
        @else
            Basket is empty
        @endif

</div>
