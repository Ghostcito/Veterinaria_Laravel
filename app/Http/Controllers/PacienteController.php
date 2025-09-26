<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $pacientes = Paciente::all();



        // $query = $query->orderBy('fecha_registro', 'desc')->paginate(10);
        $especies = Paciente::distinct()->pluck('especie');

        return view('pacientes.index', compact('pacientes', 'especies'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|string|max:50',
            'raza' => 'nullable|string|max:50',
            'edad' => 'nullable|integer|min:0',
            'nombre_duenio' => 'required|string|max:100',
            'telefono_duenio' => 'nullable|string|max:20',
            'email_duenio' => 'nullable|email'
        ]);

        Paciente::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Paciente registrado exitosamente'
        ]);
    }

    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        return response()->json($paciente);
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'especie' => 'required|string|max:50',
            'raza' => 'nullable|string|max:50',
            'edad' => 'nullable|integer|min:0',
            'nombre_duenio' => 'required|string|max:100',
            'telefono_duenio' => 'nullable|string|max:20',
            'email_duenio' => 'nullable|email'
        ]);

        $paciente->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Paciente actualizado exitosamente'
        ]);
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return response()->json([
            'success' => true,
            'message' => 'Paciente eliminado exitosamente'
        ]);
    }

    public function tratamientos(Paciente $paciente)
    {
        $tratamientos = $paciente->tratamientos()->orderBy('fecha', 'desc')->paginate(10);
        return view('pacientes.tratamientos', compact('paciente', 'tratamientos'));
    }
}
