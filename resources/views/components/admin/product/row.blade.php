
<tr>
    <td>
        {{ $product->id }}
    </td>
    <td>
        {{ $product->status }}
    </td>
    <td>
        <img src="{{ $product->mainPhoto->url ?? '' }}" alt="product image">
    </td>
    <td class="w-75">
        {{ $product->title }}
    </td>
    <td>
        <a class="btn btn-warning" href="{{ route('admin.products.edit', $product) }}">
            <i class="bi bi-pencil"></i>
        </a>
        <button
            type='button' class="btn btn-danger" wire:click="$emit('openModal', 'admin.product.delete-modal', {{ json_encode(['product' => $product]) }})">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>


