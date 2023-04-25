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
        $userProducts = auth()->user()->basketProducts()->get();

        if ($userProducts->count() === 0) {
            return redirect()->route('user.basket.index');
        };

        $order = auth()->user()->orders()->create([
            'id' => uuid_create(),
        ]);

        $orderTotal = 0;

        foreach($userProducts as $userProduct){
            if ($userProduct->product->countryPrice()->count() === 1) {
                $productTotal = $userProduct->product->countryPrice[0]->price * $userProduct->quantity;

                $orderTotal += $productTotal;

                $order->orderProducts()->create([
                    'product_id' => $userProduct->product->id,
                    'quantity' => $userProduct->quantity,
                    'total' => $productTotal
                ]);
            }
        }

        $order->total = $orderTotal;

        $order->save();

        $currency = Currency::where('locale', app()->getLocale())->select('code')->first();

        $url = $service->checkout($orderTotal * 100, $currency->code, $order->id);

        auth()->user()->basketProducts()->delete();

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
