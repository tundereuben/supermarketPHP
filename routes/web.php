<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceholderActionController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WishlistController;

Route::get('/', [StorefrontController::class, 'home'])->name('home');
Route::get('/about', fn (StorefrontController $controller) => $controller->page('about'))->name('about');
Route::get('/contact', fn (StorefrontController $controller) => $controller->page('contact'))->name('contact');
Route::get('/faq', fn (StorefrontController $controller) => $controller->page('faq'))->name('faq');
Route::get('/products', [StorefrontController::class, 'products'])->name('products.index');
Route::get('/products/{slug}', [StorefrontController::class, 'product'])->name('products.show');
Route::get('/cart', [StorefrontController::class, 'cart'])->name('cart.index');
Route::post('/cart/add/{slug}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/ui-shell-action', PlaceholderActionController::class)->name('placeholder.action');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/checkout/confirmation/{order}', [OrderController::class, 'confirmation'])->name('checkout.confirmation');
    Route::post('/subscribe/{subscription}', [SubscriptionController::class, 'subscribe'])->name('subscriptions.subscribe');
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile.edit');
    Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('orders.index');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove/{wishlistId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::resource('/products', AdminProductController::class);
    Route::get('/subscriptions', [AdminController::class, 'subscriptions'])->name('subscriptions.index');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers.index');
});
