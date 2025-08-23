<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('customer', CustomerController::class);
Route::get('/customer/load-more', [App\Http\Controllers\CustomerController::class, 'loadMore'])->name('customer.loadMore');