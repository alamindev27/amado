<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('category', CategoryController::class);


Route::get('/settings', [ProfileController::class, 'setting'])->name('setting');
Route::post('/update/profile', [ProfileController::class, 'UpdateProfile'])->name('profile.update');
Route::post('/update/password', [ProfileController::class, 'UpdatePassword'])->name('update.password');
