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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenController;
use App\Http\Controllers\WomenController;
use App\Http\Controllers\GoogleAuthController;
use App\Models\Contact;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\storeController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {
    Mail::raw('This is a test email.', function ($message) {
        $message->to('batish844@gmail.com')->subject('Test Email');
    });

    return 'Email sent!';
});

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
    Route::put('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::put('/messages/mark-read/{id}', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
    Route::put('users/{user}/toggleStatus', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::put('products/{product}/toggleStatus', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');

});
Route::get('/gender/{gender}', [CategoryController::class, 'getCategoriesByGender']);
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

Route::get('analytics/data', [AnalyticsController::class, 'getData'])->name('analytics.data');

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::get('users/search', [UserController::class, 'search'])->name('users.search');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/messages/search', [MessageController::class, 'search'])->name('messages.search');
Route::get('/orders/search', [OrderController::class, 'search'])->name('orders.search');
Route::get('/men/search', [MenController::class, 'filterProducts'])->name('men.filter.products');
Route::get('/women/search', [WomenController::class, 'filterProducts'])->name('women.filter.products');


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
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/products/export', [ProductController::class, 'exportCsv'])->name('products.export');
Route::get('/users/export', [UserController::class, 'exportCsv'])->name('users.export');
Route::get('/messages/export', [MessageController::class, 'exportCsv'])->name('messages.export');
Route::get('/orders/export', [OrderController::class, 'exportCsv'])->name('orders.export');


// Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Static Pages Routes
Route::get('/about-us', function () {
    return view('about');
});
Route::get('/women', [WomenController::class, 'index']);
Route::get('/men', [MenController::class, 'index']);
Route::get('/store/{id}', [StoreController::class, 'show'])->name('store.show');
Route::post('store/{id}/reviews', [StoreController::class, 'store'])->name('reviews.store');
Route::patch('store/{id}/reviews', [StoreController::class, 'update'])->name('reviews.update');

Route::get('/contact-us', [ContactController::class, 'index']);
Route::post('/contact-us', [ContactController::class, 'store'])->name('contacts.store');


Route::get('/checkout', function () {
    return view('checkout');
});

Route::post('/profile/account', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
Route::delete('/profile/account', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');

Route::resource('items', ProductController::class);
Route::fallback(function () {
    return response()->view('404', [], 404);
});
require __DIR__ . '/auth.php';
