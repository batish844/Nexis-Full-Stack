<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/home', function () {
    $slides = [['label' => 'women', 'url' => 'women', 'image' => 'slide1.webp'],['label' => 'men','url' => 'men','image' => 'slide2.webp'],['label' => 'Offers','url' => 'women','image' => 'slide3.webp']];
    $items= [['url' => 'men', 'image' => 'c1.jpg', 'label' => "Nexus Original's Men Shirt"], ['url' => 'women', 'image' => 'I3.jpg', 'label' => "Nexus Original's Women Shirt"], ['url' => 'men', 'image' => 'c3.jpg', 'label' => "Nexus Original's Men Shirt"]];
    return view('home',compact('items','slides'));
});
Route::get('/about-us', function () {
    return view('about');
});
Route::get('/women', function () {
    return view('women');
});
Route::get('/men', function () {
    return view('men');
});
Route::get('/contact-us', function () {
    return view('contactus');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/checkout', function () {
    return view('checkout');
});
Route::get('/loginN', function () {
    return view('login');
});

require __DIR__.'/auth.php';
