<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Models\Section;
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
    Route::get('/news', function () {
        return Inertia::render('News/Index/NewsList');
    })->middleware('can:news.view')->name('news');

//    Route::get('/blog', function () {
//        return Inertia::render('Blog/Index/BlogList');
//    })->middleware('can:blog.view')->name('blog');

    Route::get('/blog', [BlogController::class, 'index'])->middleware('can:blog.view')->name('blog');
    Route::group(['middleware' => ['can:blog.manage']], function () {
        Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    });
//      0 => 'blog.view',
//      1 => 'blog.manage',
//      2 => 'news.view',
//      3 => 'news.manage',
//      4 => 'role.view',
//      5 => 'role.manage',

    Route::get('/role', [RoleController::class, 'index'])->middleware('can:role.view')->name('role');

    Route::group(['middleware' => ['can:role.manage']], function () {
        Route::get('/permission/{roleId}', [PermissionController::class, 'edit']);
        Route::post('/permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    });

    Route::get('/section', [SectionController::class, 'index'])->name('section.list');

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::resource('/user', UserController::class);
    });
});
