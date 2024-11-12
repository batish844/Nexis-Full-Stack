<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AnalyticsController;

Route::get('/', function () {
    return redirect()->route('home');
});
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('orders', OrderController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('analytics', AnalyticsController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/account', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/orders', [ProfileController::class, 'order'])->name('profile.orders');
});
Route::get('/home', function () {
    $slides = [['label' => 'women', 'url' => 'women', 'image' => 'slide1.webp'], ['label' => 'men', 'url' => 'men', 'image' => 'slide2.webp'], ['label' => 'Offers', 'url' => 'women', 'image' => 'slide3.webp']];
    $items = [['url' => 'men', 'image' => 'c1.jpg', 'label' => "Nexus Original's Men Shirt"], ['url' => 'women', 'image' => 'I3.jpg', 'label' => "Nexus Original's Women Shirt"], ['url' => 'men', 'image' => 'c3.jpg', 'label' => "Nexus Original's Men Shirt"]];
    return view('home', compact('items', 'slides'));
})->name('home');
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
})->name('contact-us');
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/checkout', function () {
    return view('checkout');
});


require __DIR__ . '/auth.php';
