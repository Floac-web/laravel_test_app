<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function success(Order $order, OrderPayment $orderPayment)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        return view('user.payment.success', compact('orderPayment'));
    }

    public function response(Request $request)
    {
        $result = new \Cloudipsp\Result\Result($request->all(), 'test');

        if (! $result->isApproved()) {
            abort(429);
        }

        $data = $result->getData();

        dd($result, $result->isApproved(), );
        Order::whereId($data['order_id'])->update([
            'status' => $request->input('order_status')
        ]);

        $order = $request->input('order_id');

        $orderPayment = OrderPayment::create([
            'order_id' => $request->input('order_id'),
            'payment_id' => $request->input('payment_id'),
            'currency' => $request->input('currency'),
            'amount' => $request->input('amount') / 100,
            'status' => $request->input('response_status'),
            'system' => $request->input('payment_system')
        ]);

        return redirect()->route('payment.success', compact('order', 'orderPayment'));
    }
}
