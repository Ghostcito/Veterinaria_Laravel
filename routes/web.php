<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\PacienteController;

use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('home');
// });
Route::resource('/', controller: HomeController::class);
Route::resource('pacientes', PacienteController::class);
Route::resource('tratamientos', TratamientoController::class);