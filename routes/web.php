<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenController;
use App\Http\Controllers\WomenController;
use App\Http\Controllers\GoogleAuthController;
use App\Models\Contact;
use App\Http\Controllers\ReviewController;


Route::get('/', function () {
    return redirect()->route('home');
});

// Admin Routes with role:admin middleware
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('analytics', AnalyticsController::class);
    Route::resource('messages', MessageController::class);
    Route::put('/messages/mark-read/{id}', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
    Route::put('users/{user}/toggleStatus', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::put('products/{product}/toggleStatus', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');
});

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::get('users/search', [UserController::class, 'search'])->name('users.search');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/messages/search', [MessageController::class, 'search'])->name('messages.search');


// User Profile Routes
Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/account', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/orders', [ProfileController::class, 'order'])->name('profile.orders');
    Route::get('/profile/wishlist', function () {
        return view('profile.wishlist');
    })->name('profile.wishlist');
});
Route::get('/products/export', [ProductController::class, 'exportCsv'])->name('products.export');
Route::get('/users/export', [UserController::class, 'exportCsv'])->name('users.export');
Route::get('/messages/export', [MessageController::class, 'exportCsv'])->name('messages.export');

// Home Page
Route::get('/home', function () {
    $slides = [['label' => 'women', 'url' => 'women', 'image' => 'h1.webp'], ['label' => 'men', 'url' => 'men', 'image' => 'h2.webp'], ['label' => 'Offers', 'url' => 'women', 'image' => 'h3.webp']];
    $items = [['url' => 'men', 'image' => 'img/home/c1.jpg', 'label' => "Nexus Original's Men Shirt"], ['url' => 'women', 'image' => 'img/home/I3.jpg', 'label' => "Nexus Original's Women Shirt"], ['url' => 'men', 'image' => 'img/home/c3.jpg', 'label' => "Nexus Original's Men Shirt"]];
    return view('home', compact('items', 'slides'));
})->name('home');

// Static Pages Routes
Route::get('/about-us', function () {
    return view('about');
});
Route::get('/women', [WomenController::class, 'index']);
Route::get('/men', [MenController::class, 'index']);
Route::get('/men/{id}', [MenController::class, 'show'])->name('men.show');

Route::get('men/{id}/reviews', [ReviewController::class, 'show'])->name('reviews.show');
Route::post('men/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::patch('men/{id}/reviews', [ReviewController::class, 'update'])->name('reviews.update');

Route::get('/contact-us', [ContactController::class, 'index']);
Route::post('/contact-us', [ContactController::class, 'store'])->name('contacts.store');

// Cart and Checkout Routes
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/checkout', function () {
    return view('checkout');
});

Route::post('/profile/account', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
Route::delete('/profile/account', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
Route::get('/filter/men', [MenController::class, 'filterProducts'])->name('men.filter.products');
Route::get('/filter/women', [WomenController::class, 'filterProducts'])->name('women.filter.products');

Route::resource('items', ProductController::class);
Route::fallback(function () {
    return response()->view('404', [], 404);
});
require __DIR__ . '/auth.php';
