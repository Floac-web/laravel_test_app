<div class="mb-5">
    <a href="{{ route('user.orders.index') }}">orders</a>
    <hr>
    <button wire:click="refresh">ref</button>
        {{-- @if(isset($basketProducts) && $basketProducts->count() > 0) --}}
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">title</th>
                    <th scope="col">total</th>
                    <th scope="col">count</th>
                    <th scope='col'>actions</th>
                </tr>
                </thead>
                @foreach (basket()->getItems() as $basketProduct)
                    @livewire('basket-item', compact('basketProduct'), key($basketProduct->id))
                @endforeach
                <tr>
                    <td colspan="5">Basket Total:  {{ basket()->sum() }}</td>
                </tr>
            </table>
            @livewire('user.order.form') <br>
        {{-- @else
            Basket is empty
        @endif --}}

</div>
