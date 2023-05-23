<?php

namespace App\Services;

use App\Contracts\PaymentCheckoutInterface;
use App\Contracts\PaymentStatusInterface;
use App\Enums\FondyPaymentStatusEnum;
use App\Enums\PaymentStatusEnum;

use App\Interfaces\StatusInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Enum;

class FondyPaymentService implements PaymentStatusInterface, PaymentCheckoutInterface
{
    public function __construct()
    {
        \Cloudipsp\Configuration::setMerchantId(config('app.merchant_id'));
        \Cloudipsp\Configuration::setSecretKey(config('app.secret_key'));
    }

    public function checkout($order_id, $amount = 1000, $currency = 'UAN'): String|false
    {
        $data = [
          'order_desc' => 'tests SDK',
          'currency' => $currency,
          'amount' => $amount,
          'response_url' => route('payment.response', ['order' => $order_id]),
          'server_callback_url' => route('payment.response', ['order' => $order_id]),
          'order_id' => $order_id,
          'lifetime' => 3,
        ];

        $url = \Cloudipsp\Checkout::url($data);

        if ($url->getData()['response_status'] !== 'success') {
            return false;
        }

        return $url->getData()["checkout_url"];
    }

    public function getStatus($order_id): PaymentStatusEnum|false
    {
        $status = \Cloudipsp\Order::status(compact('order_id'))->getData()['order_status'];

        switch ($status) {
            case 'created';
            case 'processing';
                return PaymentStatusEnum::Processing;
                break;
            case 'declined';
            case 'expired';
            case 'reversed';
                return PaymentStatusEnum::Failed;
                break;
            case 'approved':
                return PaymentStatusEnum::Approved;
                break;
            default:
                return false;
                break;
        }
    }

    public function checkStatus($order_id, PaymentStatusEnum $status) : bool
    {
        return $this->getStatus($order_id) === $status;
    }

}
