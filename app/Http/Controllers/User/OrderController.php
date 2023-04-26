<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityWarehouse;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderProduct;

use App\Models\Product;
use App\Services\FondyPaymentService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('orderProducts')->paginate(3);

        return view('user.orders.index', compact('orders'));
    }

    public function store(FondyPaymentService $service)
    {
        $currency = Currency::where('locale', app()->getLocale())->select('code')->first();

        if (! isset($currency)) {
            return redirect()->route('user.basket.index');
        }

        $basket = auth()->user()->basket()->first();

        $order = auth()->user()->orders()->create([
            'total' => $basket->total
        ]);

        $url = $service->checkout($basket->total * 100, $currency->code, $order->id);

        if ($url->getData()['response_status'] !== 'success') {
            return redirect()->route('user.basket.index');
        }

        $basketProducts = $basket->basketProducts()->get()->toArray();

        $order->orderProducts()->createMany($basketProducts);

        $url->toCheckout();
    }

    public function show(Order $order)
    {
        if($order->user_id !== auth()->id()){
            abort(404);
        }

        return view('user.orders.show', compact('order'));
    }

    // public function destroy(Order $order)
    // {
    //     if($order->user_id === auth()->id()){
    //         $order->delete();
    //     }

    //     return redirect()->route('user.orders.index');
    // }

}
