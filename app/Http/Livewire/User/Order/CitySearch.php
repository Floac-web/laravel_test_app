<?php

namespace App\Http\Livewire\User\Order;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CitySearch extends Component
{
    public $value;

    public Collection $cities;

    public $showSearched = false;

    protected function rules() {
        return [
            'city' => ['required', 'string'],
        ];
    }

    public function setCity(City $city)
    {
        $this->value = $city['name'];

        $this->showSearched = false;

        $this->emitUp('citySeted', $city);
    }

    public function render()
    {
        $searchValue = $this->value . '%';

        $this->cities = City::where('name', 'LIKE', $searchValue)->take(10)->get();

        return view('livewire.user.order.city-search');
    }
}
