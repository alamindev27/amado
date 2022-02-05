<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [FrontendController::class, 'index'])->name('frontend');
Route::get('category/{slug}', [FrontendController::class, 'shop'])->name('shop');
Route::get('product/{slug}', [FrontendController::class, 'productDetails'])->name('product.details');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('category', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('brand', BrandController::class);


Route::get('/settings', [ProfileController::class, 'setting'])->name('setting');
Route::post('/update/profile', [ProfileController::class, 'UpdateProfile'])->name('profile.update');
Route::post('/update/password', [ProfileController::class, 'UpdatePassword']);
Route::post('/update/email', [ProfileController::class, 'UpdateEmail']);
Route::post('/add/admin', [ProfileController::class, 'addAdmin']);




