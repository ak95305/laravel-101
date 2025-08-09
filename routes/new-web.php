<?php

use Illuminate\Support\Facades\Route;

Route::get('blog/{slug}', function($slug) {
    dd($slug);
});

Route::get('blog/{slug}/comment/{commentId}', function($slug, $commentId) {
    dump($slug);
    dd($commentId);
});

Route::get('order/{slug}/comment/{commentId?}', function($slug, $commentId = "123") {
    dump($slug);
    dd(@$commentId);
});

Route::get('order/{id}', function($id) {
    dump($id);
    dump(route("blogs"));
})->where("id", "[0-9]+");

Route::get('blogs', function() {
    dump('asdf');
})->name("blogs");


Route::prefix("admin")->group(function() {
    Route::get('/users', function () {
        return 'Admin Users Page';
    });

    Route::get('/settings', function () {
        return 'Admin Settings Page';
    });
});

Route::middleware(['web'])->group(function () {
    Route::get('/profile', function () {
        return 'Your Profile';
    });

    Route::get('/orders', function () {
        return 'Your Orders';
    });
});

Route::fallback(function () {
    return 'Page not found!';
});