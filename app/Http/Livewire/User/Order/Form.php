<?php

namespace App\Http\Livewire\User\Order;

use App\Console\Commands\WareHouses;
use App\Models\City;
use App\Models\CityWarehouse;
use App\Models\Currency;
use App\Services\FondyPaymentService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Form extends Component
{
    public City $city;

    public CityWarehouse $cityWarehouse;

    public $paymentType;

    protected $listeners = [
        'citySeted' => 'setCity',
        'warehouseSeted' => 'setWarehouse'
    ];

    protected function rules() {
        return [
            'paymentType' => ['required', 'string', 'in:online,cash']
        ];
    }

    public function setWarehouse(CityWarehouse $cityWarehouse)
    {
        $this->cityWarehouse = $cityWarehouse;
    }

    public function setCity(City $city)
    {
        $this->city = $city;
    }

    public function order()
    {
        $data = $this->validate();

        switch ($data['paymentType']) {
            case 'online':
                    $this->fondyOrder();
                break;
            case 'cash':
                    $this->cashOrder();
                break;
        }
    }

    public function fondyOrder()
    {
        DB::beginTransaction();

        $service = new FondyPaymentService;

        $currency = Currency::where('locale', app()->getLocale())->select('code')->first();

        if (! isset($currency)) {
            return redirect()->route('user.basket.index');
        }

        $basket = auth()->user()->basket()->first();

        $order = auth()->user()->orders()->create([
            'total' => $basket->total
        ]);

        $basketProducts = $basket->basketProducts()->get()->toArray();

        $order->orderProducts()->createMany($basketProducts);

        $url = $service->checkout(
            $basket->total * 100,
            $currency->code,
            $order->id,
            $this->city->id,
            $this->cityWarehouse->id
        );

        if ($url) {
            DB::commit();

            return redirect($url->getData()["checkout_url"]);
        }

        DB::rollBack();
    }

    public function cashOrder()
    {
        $currency = Currency::where('locale', app()->getLocale())->select('code')->first();

        if (! isset($currency)) {
            return redirect()->route('user.basket.index');
        }

        $basket = auth()->user()->basket()->first();

        $order = auth()->user()->orders()->create([
            'total' => $basket->total
        ]);

        $basketProducts = $basket->basketProducts()->get()->toArray();

        $order->orderProducts()->createMany($basketProducts);

        $order->updateOrCreate([
            'status' => 'approved',
        ]);

        $orderPayment = $order->orderPayments()->updateOrCreate([
            'currency' => $currency->code,
            'amount' => $basket->total,
            'status' => 'waiting',
            'system' => 'cash'
        ]);

        $orderAddress = $order->orderAddress()->updateOrCreate([
            'city_id' =>  $this->city->id,
            'city_warehouse_id' => $this->cityWarehouse->id,
        ]);

        return redirect()->route('payment.success', compact('order', 'orderPayment', 'orderAddress'));
    }

    public function render()
    {
        return view('livewire.user.order.form');
    }
}
