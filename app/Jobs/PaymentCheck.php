<?php

namespace App\Jobs;

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
        Order::whereStatus('in progres')->chunk(100, function ($orders) use ($service) {
            foreach($orders as $order) {
                $payment = $service->paymentStatus($order->id);
                if ($payment['order_status'] === 'expired') {
                    $order->update([
                        'status' => 'failure'
                    ]);
                };
            }
        });
    }
}
