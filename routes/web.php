<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');


Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');


Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout');

Route::post('/checkout/manual', [CheckoutController::class, 'manualCheckout'])
    ->name('checkout.manual');

Route::post('/checkout/paystack', [CheckoutController::class, 'paystackCheckout'])
    ->name('checkout.paystack');