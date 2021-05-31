<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome8');
});
Route::get('top', 'App\Http\Controllers\TopPageController@index');
Route::post('top', 'App\Http\Controllers\TopPageController@index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
