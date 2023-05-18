<?php

namespace App\Services;

use App\Models\CityWarehouse;

class OrderService
{
    public function getItems()
    {
        return auth()->user()->orders;
    }

    public function baseOrder(CityWarehouse $cityWarehouse, $is_api = false, $cityId = null)
    {
        $order = auth()->user()->orders()->create([
            'total' => basket()->sum(),
            'api' => $is_api
        ]);

        $basketProducts = basket()->getItems()->toArray();

        $order->orderProducts()->createMany($basketProducts);

        $order->orderAddress()->updateOrCreate([
            'city_id' =>  $cityWarehouse->city->id,
            'city_warehouse_id' => $cityWarehouse->id,
        ]);

        return $order;
    }

    public function cashPay($currencyCode, $order)
    {
        $order->update([
            'status' => 'approved',
        ]);

        $orderPayment = $order->orderPayments()->updateOrCreate([
            'currency' => $currencyCode,
            'amount' => $order->total,
            'status' => 'waiting',
            'system' => 'cash'
        ]);

        return $orderPayment;
    }

    public function onlinePay($currencyCode, $order)
    {
        $service = new FondyPaymentService();

        $url = $service->checkout(
            $order->total * 100,
            $currencyCode,
            $order->id
        );

        if ($url) {
            return $url->getData()["checkout_url"];
        }

        return false;
    }
}
