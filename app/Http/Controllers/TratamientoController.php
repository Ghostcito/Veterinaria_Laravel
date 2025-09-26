<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Models\Paciente;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    public function index()
    {
        return redirect()->route('tratamientos.todos');
    }

    public function todos(Request $request)
    {
        $query = Tratamiento::with('paciente');

        // Filtro por búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('descripcion', 'like', "%{$search}%")
                    ->orWhere('veterinario', 'like', "%{$search}%")
                    ->orWhereHas('paciente', function ($pq) use ($search) {
                        $pq->where('nombre', 'like', "%{$search}%");
                    });
            });
        }

        // Filtro por fecha
        if ($request->filled('fecha_desde')) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }

        $tratamientos = $query->orderBy('fecha', 'desc')->paginate(15);
        $pacientes = Paciente::orderBy('nombre')->get();

        return view('tratamientos.todos', compact('tratamientos', 'pacientes'));
    }

    public function create()
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        return view('tratamientos.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'veterinario' => 'nullable|string|max:100',
            'costo' => 'nullable|numeric|min:0'
        ]);

        Tratamiento::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tratamiento registrado exitosamente'
        ]);
    }

    public function show(Tratamiento $tratamiento)
    {
        return view('tratamientos.show', compact('tratamiento'));
    }

    public function edit(Tratamiento $tratamiento)
    {
        return response()->json($tratamiento);
    }

    public function update(Request $request, Tratamiento $tratamiento)
    {
        $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'veterinario' => 'nullable|string|max:100',
            'costo' => 'nullable|numeric|min:0'
        ]);

        $tratamiento->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tratamiento actualizado exitosamente'
        ]);
    }

    public function destroy(Tratamiento $tratamiento)
    {
        $tratamiento->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tratamiento eliminado exitosamente'
        ]);
    }
}
