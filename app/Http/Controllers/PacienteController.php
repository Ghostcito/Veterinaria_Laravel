<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Controllers\Controller;
use Date;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pacientes = new Paciente();
        $pacientes->nombre = $request->input('nombre');
        $pacientes->especie = $request->input('especie');
        $pacientes->raza = $request->input('raza');
        $pacientes->edad = $request->input('edad');
        $pacientes->nombre_duenio = $request->input('nombre_duenio');
        $pacientes->telefono_duenio = $request->input('telefono_duenio');
        $pacientes->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|string|max:50',
            'raza' => 'nullable|string|max:50',
            'edad' => 'nullable|integer|min:0',
            'nombre_duenio' => 'required|string|max:100',
            'telefono_duenio' => 'nullable|string|max:20',
        ]);

        // Buscar paciente
        $paciente = Paciente::findOrFail($id);

        // Actualizar con los datos enviados
        $paciente->update($request->all());

        // Redirigir con mensaje
        return redirect()->back()->with('success', 'Paciente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->back()->with('success', 'Paciente eliminado correctamente.');
    }
}
