<?php

namespace App\Services;

class FondyPaymentService
{
    public function checkout($amount = 1000, $currency = 'UAN', $order_id, $cityId, $cityWarehouseId)
    {
        \Cloudipsp\Configuration::setMerchantId(config('app.merchant_id'));
        \Cloudipsp\Configuration::setSecretKey(config('app.secret_key'));

        $data = [
              'order_desc' => 'tests SDK',
              'currency' => $currency,
              'amount' => $amount,
              'response_url' => route('payment.response', ['order' => $order_id]),
              'server_callback_url' => route('payment.response', ['order' => $order_id]),
              'lang' => 'uk',
              'order_id' => $order_id,
              'lifetime' => 36000,
              'merchant_data' => array(
                'city_id' => $cityId,
                'city_warehouse_id' => $cityWarehouseId,
            )
          ];

        $url = \Cloudipsp\Checkout::url($data);

        if ($url->getData()['response_status'] !== 'success') {
            return false;
        }

        return $url;
    }
}
