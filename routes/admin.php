<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\StatisticController;

Route::resource('products', AdminProductController::class, [
    'only' => ['index', 'show', 'edit', 'create']
]);

// Route::prefix('products/{product}')->name('products.')
// ->controller(AdminProductController::class)
// ->group(function () {
//     Route::prefix('photos')->name('photos.')->group(function () {
//         Route::get('/', 'photos')->name('index');
//         // Route::get('add', 'storePhoto')->name('store');
//     });
// });

Route::resource('categories', AdminCategoryController::class);

Route::resource('orders', AdminOrderController::class, [
    'only' => ['index', 'show', 'update', 'destroy', 'edit']
]);
Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('users/{user}', [AdminOrderController::class, 'userOrders'])->name('users');
});

Route::prefix('statistics')->name('statistics.')->controller(StatisticController::class)->group(function () {
        Route::get('/orders', 'index')->name('index');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::get('/{from}/{to}/show', 'show')->name('show');
});
