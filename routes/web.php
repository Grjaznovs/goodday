<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
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
    Route::group(['middleware' => ['can:news.view']], function () {
        Route::get('/news', [NewsController::class, 'index'])->name('news');
        Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
    });

    Route::group(['middleware' => ['can:news.manage']], function () {
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    Route::group(['middleware' => ['can:blog.view']], function () {
        Route::get('/blog', [BlogController::class, 'index'])->name('blog');
        Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
    });

    Route::group(['middleware' => ['can:blog.manage']], function () {
        Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
        Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
    });

    Route::get('/role', [RoleController::class, 'index'])->middleware('can:role.view')->name('role');

    Route::group(['middleware' => ['can:role.manage']], function () {
        Route::get('/permission/{roleId}', [PermissionController::class, 'edit']);
        Route::post('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    });

    Route::get('/section', [SectionController::class, 'index'])->name('section.list');

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    });
});
