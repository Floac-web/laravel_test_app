<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from = $request->from ? Carbon::parse($request->from) : null;
        $to = $request->to ? Carbon::parse($request->to) : null;

        // dd($from, $to);

        // $ordersCount = Order::query()
        //     ->when($to, fn ($b, $v) => $b->where('created_at', '<', $v))
        //     ->when($from, fn ($b, $v) => $b->where('created_at', '>', $v))
        //     ->count();




        // dd($ordersCount);

                // dd($orders->total());

                // $ordersCount = Order::count();

                // $orderProductsCount = OrderProduct::sum('quantity');

                // ASC
                $prds = OrderProduct::query()
                    ->when($to, fn ($b, $v) => $b->where('created_at', '<', $v))
                    ->when($from, fn ($b, $v) => $b->where('created_at', '>', $v))
                    ->selectRaw('product_id, SUM(quantity) AS total')
                    ->groupBy('product_id')
                    ->orderBy('total', 'asc')
                    ->paginate(3);


                    // dd($prds);


                // dd($uniqProductsCount);

                // $weekAgo = now()->subDays(7);

                // $uniqProducts = OrderProduct::whereBetween('created_at', [$weekAgo, now()])
                //     ->selectRaw('product_id')
                //     ->groupBy('product_id')
                //     ->get();

                // dd($uniqProducts);

                // dd($uniqProductsCount);


                // dd($orderProductsCount);
                // dd($orders->orderProducts);

                return view('admin.statistics.orders-uniq', compact('prds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($from, $to)
    {
        $daysAgoStart = now()->subDays($from);

        $daysAgoEnd = now()->subDays($to);

        $ordersCount = Order::whereBetween('created_at', [$daysAgoStart, $daysAgoEnd])->count();

        dd($ordersCount);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('admin.statistics.period');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $from = $request->from;

        $to = $request->to;

        return redirect()->route('admin.statistics.show', compact('from', 'to'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
