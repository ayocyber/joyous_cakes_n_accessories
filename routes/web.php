<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/shop', function () {
    return view('pages.Shop');
})->name('shop');


Route::get('/contact', function () {
    return view('pages.Contact');
})->name('contact');

Route::get('/cart', function () {
    return view('pages.Cart');
})->name('cart');
