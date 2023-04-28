<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BasketController as UserBasketController;
use App\Http\Controllers\User\OrderController as UserOrderController;

Route::prefix('basket')->name('basket.')->controller(UserBasketController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/add/{product}', 'add')->name('add');
            Route::patch('/update/{product}', 'update')->name('update');
            Route::delete('/remove/{product}', 'remove')->name('remove');
        });

Route::resource('orders', UserOrderController::class, [
    'only' => ['index', 'show', 'destroy']
]);

Route::middleware('empty.basket')->post('orders/{city}/{cityWarehouse}', [UserOrderController::class, 'store'])->name('orders.store');
