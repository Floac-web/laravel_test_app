<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentWayRequest;
use App\Http\Resources\OrderPayResource;
use App\Http\Resources\OrderResource;
use App\Models\CityWarehouse;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order()->getItems();

        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        if($order->user_id !== auth()->id()){
            abort(404);
        }

        return response([
            'order' => new OrderResource($order)
        ]);
    }

    public function store(PaymentWayRequest $request, CityWarehouse $cityWarehouse)
    {
        $data = $request->validated();

        $currency = Currency::where('locale', app()->getLocale())->select('code')->first();

        if (! isset($currency)) {
            return response([
                'status' => 'error'
            ],500);
        }

        $order = order()->baseOrder($cityWarehouse, true);

        switch ($data['paymentType']) {
            case 'online':
                    $orderPay = order()->onlinePay($currency->code, $order);
                break;
            case 'cash':
                    $orderPay = order()->cashPay($currency->code, $order);
                break;
        }

        return response([
            'order' => new OrderResource($order),
            'orderPay' => $data['paymentType'] === 'online' ? $orderPay : new OrderPayResource($orderPay)
        ]);
    }
}
