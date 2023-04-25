<div>
    <a href="{{ route('user.orders.index') }}">orders</a>
    <hr>


        @if(isset($userProducts) && $userProducts->count() > 0)
            @foreach ($userProducts as $userProduct)
            @livewire('basket-item', ['userProduct' => $userProduct], key($userProduct->id))
            @endforeach
            @livewire('user.order.form') <br>
        @else
            Basket is empty
        @endif

</div>
