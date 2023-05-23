<?php

namespace App\Jobs;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Services\FondyPaymentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PaymentCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(FondyPaymentService $service): void
    {
        $orders = Order::waitingOnlinePay()->get();

        foreach ($orders as $order) {
            $pay_status = $service->getStatus($order->id);

            order()->switchStatus($order, $pay_status);
        }
    }
}
