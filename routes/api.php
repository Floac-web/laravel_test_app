<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route::get('/card', [CardController::class, 'index']);
// Route::middleware('auth:sanctum')->resource('card', CardController::class, [
//     'only' => ['index', 'store', 'edit', 'remove']
// ]);

Route::prefix('/card')->name('card.')->middleware('auth:sanctum')->controller(CardController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('{product}/add', 'add')->name('add');
    Route::post('{product}/update', 'update')->name('update');
    Route::post('{product}/remove', 'remove')->name('remove');
});

Route::prefix('/order')->name('order.')->middleware('auth:sanctum')->controller(OrderController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{order}/show', 'show')->name('show');
    Route::post('/{cityWarehouse}/store', 'store')->name('store');
});
