<?php

namespace App\Services;

class FondyPaymentService
{
    public function checkout($amount = 1000, $currency = 'UAN', $order_id)
    {
        \Cloudipsp\Configuration::setMerchantId(1396424);
        \Cloudipsp\Configuration::setSecretKey('test');

        $data = [
              'order_desc' => 'tests SDK',
              'currency' => $currency,
              'amount' => $amount,
              'response_url' => route('payment.response'),
              'server_callback_url' => '',
              'lang' => 'uk',
              'order_id' => $order_id,
              'lifetime' => 36000,
          ];

        $url = \Cloudipsp\Checkout::url($data);

        return $url;
    }
}
