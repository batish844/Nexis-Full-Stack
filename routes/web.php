<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});
Route::get('/About', function () {
    return view('about');
});
Route::get('/Women', function () {
    return view('women');
});
Route::get('/Men', function () {
    return view('men');
});
Route::get('/ContactUs', function () {
    return view('contactus');
});
Route::get('/Cart', function () {
    return view('cart');
});
Route::get('/Checkout', function () {
    return view('checkout');
});
Route::get('/Login', function () {
    return view('login');
});
