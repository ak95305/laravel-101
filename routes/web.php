<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, "index"]);

Route::get('/users', [UserController::class, "index"]);