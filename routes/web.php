<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/sarees', function () {
    return view('product');
})->name('sarees');

Route::get('/suits', function () {
    return view('suits');
})->name('suits');

Route::get('/lehengas', function () {
    return view('lehengas');
})->name('lehengas');

Route::get('/bridal-collection', function () {
    return view('bridal-collection');
})->name('bridal-collection');

Route::get('/bridal-packages', function () {
    return view('bridal-packages');
})->name('bridal-packages');

Route::get('/makeup-services', function () {
    return view('makeup-services');
})->name('makeup-services');

Route::get('/custom-lehenga', function () {
    return view('custom-lehenga');
})->name('custom-lehenga');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/confirmation', function () {
    return view('confirmation');
})->name('confirmation');

Route::get('/tracking', function () {
    return view('tracking');
})->name('tracking');
