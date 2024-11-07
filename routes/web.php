<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $slides = [['label' => 'Women', 'url' => 'women', 'image' => 'slide1.webp'],['label' => 'Men','url' => 'men','image' => 'slide2.webp'],['label' => 'Offers','url' => 'offers','image' => 'slide3.webp']];
    $items= [['url' => 'Men', 'image' => 'c1.jpg', 'label' => "Nexus Original's Men Shirt"], ['url' => 'Women', 'image' => 'I3.jpg', 'label' => "Nexus Original's Women Shirt"], ['url' => 'Men', 'image' => 'c3.jpg', 'label' => "Nexus Original's Men Shirt"]];
    return view('home',compact('items','slides'));
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
Route::get('/login', function () {
    return view('login');
});
