<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('top', 'App\Http\Controllers\TopPageController@index3');
Route::post('top', 'App\Http\Controllers\TopPageController@index');
