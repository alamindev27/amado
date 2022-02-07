<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Auth::routes();

Route::get('/', [FrontendController::class, 'index'])->name('frontend');
Route::get('categories/{slug}', [FrontendController::class, 'shop'])->name('shop');
Route::get('products/{slug}', [FrontendController::class, 'productDetails'])->name('product.details');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/add/to/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart', [CartController::class, 'cart'])->name('all.cart');
Route::get('/cart/{slug}/remove', [CartController::class, 'removeCart'])->name('remove.cart')->middleware('auth');
Route::post('/cart/update', [CartController::class, 'cartUpdate'])->name('cart.update')->middleware('auth');


Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'checkoutStore'])->name('checkout.store')->middleware('auth');


Route::resource('category', CategoryController::class)->middleware(['auth', 'is_admin']);
Route::resource('products', ProductController::class)->middleware(['auth', 'is_admin']);
Route::resource('brand', BrandController::class)->middleware(['auth', 'is_admin']);
Route::get('/country', [CountryController::class, 'country'])->name('country')->middleware(['auth', 'is_admin']);
Route::post('/country', [CountryController::class, 'store'])->name('country.store')->middleware(['auth', 'is_admin']);


Route::get('/settings', [ProfileController::class, 'setting'])->name('setting')->middleware(['auth', 'is_admin']);
Route::post('/update/profile', [ProfileController::class, 'UpdateProfile'])->name('profile.update')->middleware(['auth', 'is_admin']);
Route::post('/update/password', [ProfileController::class, 'UpdatePassword'])->middleware(['auth', 'is_admin']);
Route::post('/update/email', [ProfileController::class, 'UpdateEmail'])->middleware(['auth', 'is_admin']);
Route::post('/add/admin', [ProfileController::class, 'addAdmin'])->middleware(['auth', 'is_admin']);

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


