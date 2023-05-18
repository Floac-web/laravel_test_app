
<tr>
    <td>
        {{ $basketProduct->id }}
    </td>
    <td>
        <a href="{{ route('products.show', $basketProduct->product) }}">
            <h4>{{ $basketProduct->product->title }}</h4>
        </a>
    </td>
    <td><strong>{{ $basketProduct->sum }}</strong></td>
    <td>{{ $basketProduct->quantity }}</td>
    <td>
        <button  type="button" class="btn btn-default" wire:click="increment"><i class="bi bi-plus-circle-fill"></i></button>
        <button  type="button" class="btn btn-default" wire:click="decrement"><i class="bi bi-dash"></i></button>
        <button type="button" class="btn btn-default" wire:click="remove">
            <i class="bi bi-trash3"></i>
        </button>
    </td>
</tr>
