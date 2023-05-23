<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FondyPaymentStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\FondyPaymentService;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(FondyPaymentService $service)
    {
        // dd(Order::whereStatus(OrderStatusEnum::Wait)->get());
        // dd(OrderStatusEnum::Approved->value);
        // dd($service->paymentStatus('a9962d78-5532-4787-a475-fbfb966d10cd'));

        // dd(Order::waitingOnlinePay()->get());

        // dd(order()->getItem('a101877c-1fa8-4f22-9952-2a5f0f0215a2'));
        // $pay_status = $service->getStatus('c96fc8ce-92d4-48af-8128-554fe0c66e3b');
        // $order = Order::where('id', 'c96fc8ce-92d4-48af-8128-554fe0c66e3b')->first();
        // dd(order()->switchStatus($order, $pay_status));
        // dd($service->checkStatus('a101877c-1fa8-4f22-9952-2a5f0f0215a2', FondyPaymentStatusEnum::Processing));
        // $user = User::where('email', 'virffa18@example.com')->first();
        // dd($user);
        // session()->flash('key', '123');
        // session()->reflash();
        // dd(session('_token'));
        echo basket()->getToken();

        // return view('admin.products.index');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function create()
    {
        return view('admin.products.create');
    }
}
