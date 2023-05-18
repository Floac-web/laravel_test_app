<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentResponseRequest;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function success(Order $order, OrderPayment $orderPayment)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        return view('user.payment.success', compact('orderPayment', 'order'));
    }

    public function response(Request $request, Order $order)
    {
        $result = new \Cloudipsp\Result\Result($request->all(), 'test');

        if (! $result->isApproved()) {
            $order->status = 'failure';

            $order->save();

            return redirect()->route('user.basket.index');
        }

        $data = $result->getData();

        $order->status = $request->input('order_status');

        $order->save();

        $orderPayment = $order->orderPayments()->updateOrCreate([
            'payment_id' => $request->input('payment_id'),
            'currency' => $request->input('currency'),
            'amount' => $request->input('amount') / 100,
            'status' => $request->input('response_status'),
            'system' => $request->input('payment_system')
        ]);

        return redirect()->route('payment.success', compact('order', 'orderPayment'));
    }
}
