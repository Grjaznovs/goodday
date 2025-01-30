<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/blog/list', function () {
        return Inertia::render('Blog/Index/BlogList');
    })->name('blog');

    Route::get('/news/list', function () {
        return Inertia::render('News/Index/NewsList');
    })->name('news');

    Route::get('/role', function () {
        return Inertia::render('Role/Role');
    })->name('role');

});
