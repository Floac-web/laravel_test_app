<?php

namespace App\Http\Controllers;

use App\Models\CurrencyRate;
use App\Services\MonoRateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        $rates = CurrencyRate::with(['fromCurrency', 'toCurrency'])->get();

        return view('currencies.show', compact('rates'));
    }

    public function update(Request $request, MonoRateService $service)
    {
        $result = $service->updateRate();

        if (! $result) {
            abort(429, 'To many requests');
        }

        return redirect()->route('currencies.show');
    }
}
