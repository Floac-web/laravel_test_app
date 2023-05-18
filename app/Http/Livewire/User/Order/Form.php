<?php

namespace App\Http\Livewire\User\Order;

use App\Console\Commands\WareHouses;
use App\Models\City;
use App\Models\CityWarehouse;
use App\Models\Currency;
use App\Models\Order;
use App\Services\FondyPaymentService;
use App\Services\OrderService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Form extends Component
{
    public City $city;

    public CityWarehouse $warehouse;

    public $paymentType = 'online';

    protected $listeners = [
        'citySeted' => 'setCity',
        'warehouseSeted' => 'setWarehouse'
    ];

    protected function rules() {
        return [
            'paymentType' => ['required', 'string', 'in:online,cash']
        ];
    }

    public function setWarehouse(CityWarehouse $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    public function setCity(City $city)
    {
        $this->city = $city;
    }

    public function order(OrderService $service)
    {
        $currency = Currency::where('locale', app()->getLocale())->select('code')->first();

        if (! isset($currency)) {
            return redirect()->route('user.basket.index');
        }

        $data = $this->validate();

        $order = $service->baseOrder($this->city->id, $this->warehouse->id);

        switch ($data['paymentType']) {
            case 'online':
                    $this->onlineOrder($currency->code, $order, $service);
                break;
            case 'cash':
                    $this->cashOrder($currency->code, $order, $service);
                break;
        }
    }

    public function onlineOrder($currencyCode, $order, OrderService $service)
    {
        $payUrl = $service->onlinePay($currencyCode, $order);

        return redirect()->route('user.orders.pay', compact('order', 'payUrl'));
    }

    public function cashOrder($currencyCode, $order, OrderService $service)
    {
        $orderPayment = $service->cashPay($currencyCode, $order);

        return redirect()->route('payment.success', compact('order', 'orderPayment'));
    }

    public function render()
    {
        return view('livewire.user.order.form');
    }
}
