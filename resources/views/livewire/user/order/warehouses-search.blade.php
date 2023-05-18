
<div x-data="{ showSearched: false }">
    @include('components.form.input', [
        'id' => 'warehouse',
        'label' => 'Warehouse',
        'model' => 'value',
        'onFocus' => '$set("showSearched", "true")',
    ])
    @include('components.form.list', [
        'show' => $showSearched,
        'items' => $warehouses,
        'name' => 'address',
        'onClick' => 'setWarehouse'
    ])
<div>

