<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\BankCourse;
use App\Models\Currency;
use App\Models\CurrencyRate;
use Illuminate\Support\Facades\Http;

class MonoRateService
{
    public function updateRate()
    {
        $response = cache()->remember(
            'mono-rate',
            60*5,
            fn () => Http::get('https://api.monobank.ua/bank/currency')->json()
        );

        if(count($response) === 1){
            cache()->forget('mono-rate');
            return false;
        }

        $curencies = $response;

        $availableNumbers = Currency::pluck('number');

        foreach($curencies as $curency){
            if ($availableNumbers->contains($curency['currencyCodeA']) && $availableNumbers->contains($curency['currencyCodeB'])) {

                CurrencyRate::updateOrCreate([
                    'from' => $curency['currencyCodeA'],
                    'to' => $curency['currencyCodeB'],
                    'buy' => $curency['rateBuy'],
                    'sell' => $curency['rateSell'],
                ], [
                    'from' => $curency['currencyCodeA'],
                    'to' => $curency['currencyCodeB'],
                    'buy' => $curency['rateBuy'],
                    'sell' => $curency['rateSell'],
                    'cross' => $curency['rateCross'],
                ]);
            }
        }

        return true;
    }
}
