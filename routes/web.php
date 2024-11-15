<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\MenController;
use App\Http\Controllers\WomenController;

Route::get('/', function () {
    return redirect()->route('home');
});
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('analytics', AnalyticsController::class);
   

});

Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
;


Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/account', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/orders', [ProfileController::class, 'order'])->name('profile.orders');
});
Route::get('/home', function () {
    $slides = [['label' => 'women', 'url' => 'women', 'image' => 'h1.webp'], ['label' => 'men', 'url' => 'men', 'image' => 'h2.webp'], ['label' => 'Offers', 'url' => 'women', 'image' => 'h3.webp']];
    $items = [['url' => 'img/home', 'image' => 'c1.jpg', 'label' => "Nexus Original's Men Shirt"], ['url' => 'img/home', 'image' => 'I3.jpg', 'label' => "Nexus Original's Women Shirt"], ['url' => 'img/home', 'image' => 'c3.jpg', 'label' => "Nexus Original's Men Shirt"]];
    return view('home', compact('items', 'slides'));
})->name('home');
Route::get('/about-us', function () {
    return view('about');
});
Route::get('/women', [WomenController::class, 'index']);
Route::get('/men', [MenController::class, 'index']);

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
