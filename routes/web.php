<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('image/{imageId}', [\App\Http\Controllers\ImageController::class, 'show']);

Route::get('/visitas', 'App\Http\Controllers\PageVisitsController@index');
