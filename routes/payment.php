<?php


use App\Http\Controllers\User\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/response/{order}', [PaymentController::class, 'response'])->name('response');
Route::get('/success/{order}/{orderPayment}', [PaymentController::class, 'success'])->name('success');

