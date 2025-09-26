<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\TratamientoController;

Route::get('/', function () {
    return redirect()->route('pacientes.index');
});

// Rutas para Pacientes
Route::resource('pacientes', PacienteController::class);
Route::get('pacientes/{paciente}/tratamientos', [PacienteController::class, 'tratamientos'])->name('pacientes.tratamientos');

// Rutas para Tratamientos
Route::resource('tratamientos', TratamientoController::class);
Route::get('todos-tratamientos', [TratamientoController::class, 'todos'])->name('tratamientos.todos');




// Route::get('/', function () {
//     return view('home');
// });
// Route::resource('/', controller: HomeController::class);
// Route::resource('pacientes', PacienteController::class);
// Route::resource('tratamientos', TratamientoController::class);