<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Enums\OrderPaySystemEnum;
use App\Enums\OrderStatusEnum;
use App\Models\CityWarehouse;
use App\Models\Order;
use App\Models\OrderPayment;

class OrderService
{
    public function getItems()
    {
        return auth()->user()->orders;
    }

    public function getItem($order_id)
    {
        return auth()->user()->order($order_id)->first();
    }

    public function updatePaymentStatus(Order $order, PaymentStatusEnum $status)
    {
        $order->orderPayment()->update([
            'status' => $status
        ]);
    }

    public function updateOrderStatus(Order $order, OrderStatusEnum $status)
    {
        $order->update([
            'status' => $status
        ]);
    }

    public function updateStatus(Order $order, PaymentStatusEnum $pay_status, OrderStatusEnum $order_status)
    {
        $this->updatePaymentStatus($order, $pay_status);

        $this->updateOrderStatus($order, $order_status);
    }

    public function switchStatus(Order $order, PaymentStatusEnum $pay_status)
    {
        switch($pay_status) {
            case PaymentStatusEnum::Approved:
                $this->updateStatus($order, $pay_status, OrderStatusEnum::Approved);
                break;
            case PaymentStatusEnum::Failed:
                $this->updateStatus($order, $pay_status, OrderStatusEnum::Failed);
                break;
            case PaymentStatusEnum::Processing:
                $this->updateStatus($order, $pay_status, OrderStatusEnum::Wait);
                break;
        }
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
            'status' => OrderStatusEnum::Wait,
            'system' => OrderPaySystemEnum::Cash
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

        $orderPayment = $order->orderPayments()->updateOrCreate([
            'currency' => $currencyCode,
            'amount' => $order->total,
            'status' => OrderStatusEnum::Wait,
            'system' => OrderPaySystemEnum::Online
        ]);

        if ($url) {
            return $url;
        }

        return false;
    }
}
