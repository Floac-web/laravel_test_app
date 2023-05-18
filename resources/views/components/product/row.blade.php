
<tr>
    <td>
        <a href="{{ route('products.show', $product) }}">
            <h4>{{ $product->title }}</h4>
        </a>
    </td>
    <td><strong>{{ $total}}</strong></td>
    <td>{{ $quantity }}</td>
</tr>
