<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\NovaPoshtaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\BasketController as UserBasketController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Livewire\Admin\Product\AddLang;
use App\Http\Livewire\Admin\Product\UpdateLangForm;
use App\Http\Livewire\Counter;
use App\Http\Livewire\Admin\Product\Index as ProductIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::localizedGroup(function(){
    Route::get('/', function () {
        return view('welcome');
    });



    Route::resource('categories', CategoryController::class, [
        'only' => ['index', 'show']
    ]);

    Route::resource('products', ProductController::class, [
        'only' => ['index', 'show']
    ]);

    Route::get('counter', function () {
        return view('counter');
    });

    Route::post('currencies/update', [CurrencyController::class, 'update'])->name('currencies.update');
    Route::get('currencies', [CurrencyController::class, 'index'])->name('currencies.show');

    Route::get('/novaposhta', [NovaPoshtaController::class, 'index'])->name('novaposhta');

    Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
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
        Route::middleware('empty.basket')->post('orders', [UserOrderController::class, 'store'])->name('orders.store');

    });

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', AdminProductController::class, [
            'only' => ['index', 'show', 'edit', 'create']
        ]);

        Route::prefix('products/{product}')->name('products.')
        ->controller(AdminProductController::class)
        ->group(function () {
            Route::get('lang/{lang}/add', 'addLang')->name('lang.add');
            Route::get('lang/{lang}/update', 'updateLang')->name('lang.update');
            Route::middleware('has.lang')->get('price/{lang}/add', 'addPrice')->name('price.add');
            Route::get('price/{lang}/update', 'updatePrice')->name('price.update');
        });

        Route::resource('categories', AdminCategoryController::class);

        Route::resource('orders', AdminOrderController::class, [
            'only' => ['index', 'show', 'update', 'destroy', 'edit']
        ]);
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('users/{user}', [AdminOrderController::class, 'userOrders'])->name('users');
        });

        Route::prefix('statistics')->name('statistics.')
        ->controller(StatisticController::class)
        ->group(function () {
            Route::get('/orders', 'index')->name('index');
            Route::get('/edit', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');
            Route::get('/{from}/{to}/show', 'show')->name('show');
        });
    });


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
