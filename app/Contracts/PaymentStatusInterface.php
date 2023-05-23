<?php

namespace App\Contracts;

use App\Enums\PaymentStatusEnum;
use App\Models\Order;

interface PaymentStatusInterface
{
    public function getStatus($order_id): PaymentStatusEnum|false;
    public function checkStatus($order_id, PaymentStatusEnum $status): bool;
}
