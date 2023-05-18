<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\City;
use App\Models\CityWarehouse;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderProduct;

use App\Models\Product;
use App\Services\FondyPaymentService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('orderProducts')->paginate(3);

        return view('user.orders.index', compact('orders'));
    }

    public function pay(Order $order, Request $request)
    {
        $payUrl = $request->payUrl;

        return view('user.orders.pay', compact('order', 'payUrl'));
    }

    public function show(Order $order)
    {
        if($order->user_id !== auth()->id()){
            abort(404);
        }

        return view('user.orders.show', compact('order'));
    }
}
