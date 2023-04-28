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

    public function store(
        FondyPaymentService $service,
        City $city,
        CityWarehouse $cityWarehouse,
        PaymentRequest $request
    )
    {
        DB::beginTransaction();

        $paymentType = $request->validated()['payment-type'];

        $currency = Currency::where('locale', app()->getLocale())->select('code')->first();

        if (! isset($currency)) {
            return redirect()->route('user.basket.index');
        }

        $basket = auth()->user()->basket()->first();

        $order = auth()->user()->orders()->create([
            'total' => $basket->total
        ]);

        $basketProducts = $basket->basketProducts()->get()->toArray();

        $order->orderProducts()->createMany($basketProducts);

        if ($paymentType === 'online') {
            $url = $service->checkout(
                $basket->total * 100,
                $currency->code,
                $order->id,
                $city->id,
                $cityWarehouse->id
            );

            if ($url) {
                DB::commit();

                $url->toCheckout();
            }

            DB::rollBack();
        }

        if ($paymentType === 'cash') {
            $order->updateOrCreate([
                'status' => 'approved',
            ]);

            $orderPayment = $order->orderPayments()->updateOrCreate([
                'currency' => $currency->code,
                'amount' => $basket->total,
                'status' => 'waiting',
                'system' => 'cash'
            ]);

            $orderAddress = $order->orderAddress()->updateOrCreate([
                'city_id' =>  $city->id,
                'city_warehouse_id' => $cityWarehouse->id,
            ]);

            DB::commit();

            return redirect()->route('payment.success', compact('order', 'orderPayment', 'orderAddress'));
        }

        return redirect()->route('user.basket.index');
    }

    public function show(Order $order)
    {
        if($order->user_id !== auth()->id()){
            abort(404);
        }

        return view('user.orders.show', compact('order'));
    }
}
