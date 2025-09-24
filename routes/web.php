<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TratamientoController;

Route::get('/', function () {
    return view('home');
});
Route::get('/tratamiento', action: [TratamientoController::class, 'index']);