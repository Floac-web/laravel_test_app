<div>
<div class="bg-white p-5 rounded">
    <div>
        @include('components.form.select', [
            'id' => 'paginate',
            'label' => 'Per Page',
            'model' => 'perPage',
            'options' => $paginateOptions
        ])
    </div>
    <div>
        @include('components.form.input', [
            'id' => 'search',
            'label' => 'Search',
            'model' => "search"

        ])
    </div>
    <table class="table table-hover table-bordered">
        <thead>
            <th class="opacity-75" sortable wire:click="sortBy('id')">id</th>
            <th class="opacity-75" sortable wire:click="sortBy('status')">status</th>
            <th class="opacity-75">image</th>
            <th class="opacity-75" sortable wire:click="sortBy('title')">title</th>
            <th class="opacity-75">actions</th>
        </thead>
        <tbody>
            @foreach ($products as $product)
                @include('components.admin.product.row')
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $products->links() }}
    </div>
</div>
</div>



