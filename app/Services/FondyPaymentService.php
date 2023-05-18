<?php

namespace App\Services;

class FondyPaymentService
{
    public function __construct()
    {
        \Cloudipsp\Configuration::setMerchantId(config('app.merchant_id'));
        \Cloudipsp\Configuration::setSecretKey(config('app.secret_key'));
    }

    public function checkout($amount = 1000, $currency = 'UAN', $order_id)
    {
        $data = [
              'order_desc' => 'tests SDK',
              'currency' => $currency,
              'amount' => $amount,
              'response_url' => route('payment.response', ['order' => $order_id]),
              'server_callback_url' => route('payment.response', ['order' => $order_id]),
              'order_id' => $order_id,
              'lifetime' => 36000,
          ];

        $url = \Cloudipsp\Checkout::url($data);

        if ($url->getData()['response_status'] !== 'success') {
            return false;
        }

        return $url;
    }

    public function paymentStatus($order_id)
    {
        return \Cloudipsp\Order::status(compact('order_id'))->getData();
    }


}
