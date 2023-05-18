<?php

use App\Services\BasketService;
use App\Services\OrderService;

if (! function_exists('basket')) {
    function basket()
    {
        return resolve(BasketService::class);
    }
}

if (! function_exists('order')) {
    function order()
    {
        return resolve(OrderService::class);
    }
}

