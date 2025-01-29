<?php

use App\Http\Controllers\RickAndMortyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('rickandmorty')->group(function () {
    Route::get('/list/{page?}', [RickAndMortyController::class, 'index']);
    Route::get('/show/{id}', [RickAndMortyController::class, 'show']);
});
