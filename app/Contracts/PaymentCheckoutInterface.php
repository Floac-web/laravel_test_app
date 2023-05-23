<?php

namespace App\Contracts;

interface PaymentCheckoutInterface
{
    public function checkout($order_id, Float $amount, String $currency): String|false;
}
