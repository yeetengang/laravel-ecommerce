<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;
use App\Events\OrderUpdatedEvent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/convert-to-json', function () {
    return App\Models\Products::paginate(5);
});
Route::get('/', [ProductController::class, 'pagiData']);
Route::post('/cart', [CartController::class, 'store'])->name('cart');
Route::get('/checkout', [CartController::class, 'index'])->name('checkout');
Route::get('/checkout/get/items', [CartController::class, 'getCartItemCheckout']);
Route::post('/order/submit', [OrderController::class, 'store']);
Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::get('/order/get/orders', [OrderController::class, 'getAllOrders']);
Route::put('/order/update/{id}', [OrderController::class, 'update']);
Route::get('/updateOrder', function() {
    return view('updateOrder');
});
Route::post('/updateOrder', function() {
    $status = request()->status;

    event(new OrderUpdatedEvent($status));
});
Route::get('/notifications',[NotificationController::class, 'getNotifications']);
Route::put('/notification/update/{id}', [NotificationController::class, 'updateNotification']);