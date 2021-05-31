<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login2');
});
Route::get('top', 'App\Http\Controllers\TopPageController@index');
Route::post('top', 'App\Http\Controllers\TopPageController@index');
