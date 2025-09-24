<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});
Route::resource('/home', controller: HomeController::class);