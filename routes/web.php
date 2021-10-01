<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::get('top', 'App\Http\Controllers\TopPageController@index');
Route::post('top', 'App\Http\Controllers\TopPageController@index');
