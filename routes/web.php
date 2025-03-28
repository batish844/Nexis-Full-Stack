<?php

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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;



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
    Route::get('/profile/orders/{id}', [ProfileController::class, 'orderDetails'])->name('profile.orderDetails');
    Route::get('/profile/ordersFiltered', [ProfileController::class, 'filterOrders'])->name('profile.orders.filter');

    Route::get('/profile/wishlist', function () {
        return view('profile.wishlist');
    })->name('profile.wishlist');
});
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remaining-stock/{itemID}', [CartController::class, 'getRemainingStock'])->name('cart.remainingStock');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/orders/claim', [ProfileController::class, 'claimOrders'])->name('orders.claim');


Route::get('/products/export', [ProductController::class, 'exportCsv'])->name('products.export');
Route::get('/users/export', [UserController::class, 'exportCsv'])->name('users.export');
Route::get('/messages/export', [MessageController::class, 'exportCsv'])->name('messages.export');
Route::get('/orders/export', [OrderController::class, 'exportCsv'])->name('orders.export');


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', function () {
    return view('about');
});
Route::get('/women', [WomenController::class, 'index'])->name('store.women');
Route::get('/men', [MenController::class, 'index'])->name('store.men');
Route::get('/store/{id}', [StoreController::class, 'show'])->name('store.show');
Route::post('store/{id}/reviews', [StoreController::class, 'store'])->name('reviews.store');
Route::patch('store/{id}/reviews', [StoreController::class, 'update'])->name('reviews.update');

Route::get('/contact-us', [ContactController::class, 'index']);
Route::post('/contact-us', [ContactController::class, 'store'])->name('contacts.store');


Route::post('/profile/account', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
Route::delete('/profile/account', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');

Route::resource('items', ProductController::class);

Route::post('/checkout/session', [PaymentController::class, 'createCheckoutSession'])->name('checkout.session');
Route::get('/checkout/success', [PaymentController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/checkout/cancel', [PaymentController::class, 'checkoutCancel'])->name('checkout.cancel');


Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');
Route::get('/wishlist/count', [WishlistController::class, 'getWishlistCount'])->name('wishlist.count');

Route::fallback(function () {
    return response()->view('404', [], 404);
});
require __DIR__ . '/auth.php';
