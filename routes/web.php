<?php

// use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
// use App\Http\Controllers\Admin\ProductController as AdminProductController;
// use App\Http\Controllers\Admin\OrderController as AdminOrderController;
// use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\CurrencyController;
use App\Http\Controllers\Web\NovaPoshtaController;
use App\Http\Controllers\Web\ProductController;
// use App\Http\Controllers\User\BasketController as UserBasketController;
// use App\Http\Controllers\User\OrderController as UserOrderController;
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

Route::prefix('currencies')
    ->name('currencies.')
    ->controller(CurrencyController::class)
    ->group(function () {
        Route::get('/', 'index')->name('show');

        Route::post('update', 'update')->name('update');
});


Route::get('/novaposhta', [NovaPoshtaController::class, 'index'])->name('novaposhta');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
