<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');


Route::get('/contact', function () {
    return view('pages.Contact');
})->name('contact');


Route::get('/cart', [CartController::class, 'index'])->name('cart');
