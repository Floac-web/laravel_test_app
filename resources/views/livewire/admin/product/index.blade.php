
<div>
    @foreach ($products as $product)
        @livewire('admin.product.item', compact('product'), key($product->id))
    @endforeach
    {{ $products->links() }}
</div>

