<?php

namespace App\Http\Livewire\User\Order;

use App\Console\Commands\WareHouses;
use App\Models\City;
use App\Models\CityWarehouse;
use App\Services\FondyPaymentService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Form extends Component
{
    public City $city;

    public CityWarehouse $warehouse;

    protected $listeners = [
        'citySeted' => 'setCity',
        'warehouseSeted' => 'setWarehouse'
    ];

    public function setWarehouse(CityWarehouse $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    public function setCity(City $city)
    {
        $this->city = $city;
    }

    public function render()
    {
        return view('livewire.user.order.form');
    }
}
