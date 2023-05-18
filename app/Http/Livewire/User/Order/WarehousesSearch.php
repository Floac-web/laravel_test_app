<?php

namespace App\Http\Livewire\User\Order;

use App\Console\Commands\WareHouses;
use App\Models\City;
use App\Models\CityWarehouse;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class WarehousesSearch extends Component
{
    public $value;

    public City $city;

    public $showSearched = false;

    public Collection $warehouses;

    public function setWarehouse(CityWarehouse $warehouse)
    {
        $this->value = $warehouse['address'];

        $this->showSearched = false;

        $this->emitUp('warehouseSeted', $warehouse);
    }

    public function render()
    {
        $searchValue = '%' . $this->value . '%';

        $this->warehouses = $this->city->wareHouses()->where('address', 'LIKE', $searchValue)->take(10)->get();

        return view('livewire.user.order.warehouses-search');
    }
}
