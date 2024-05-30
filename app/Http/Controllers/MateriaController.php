<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MateriaController extends Controller
{
    // Mostrar una lista de todas las materias
    public function index()
    {
        $materias = Materia::paginate(10);
        return view('materias.index', compact('materias'));
    }

    // Mostrar el formulario para crear una nueva materia
    public function create()
    {
        return view('materias.crear');
    }

    // Guardar una nueva materia en la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'proveedor' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric'
        ]);

        try {
            Materia::create($validatedData);
            return redirect()->route('materias.index')
                             ->with('success', 'Materia creada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error creando materia: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error creando materia: ' . $e->getMessage()]);
        }
    }

    // Mostrar una materia específica
    public function show(Materia $materia)
    {
        return view('materias.show', compact('materia'));
    }

    // Mostrar el formulario para editar una materia existente
    public function edit(Materia $materia)
    {
        return view('materias.editar', compact('materia'));
    }

    // Actualizar una materia existente en la base de datos
    public function update(Request $request, Materia $materia)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'proveedor' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric'
        ]);

        try {
            $materia->update($validatedData);
            return redirect()->route('materias.index')
                             ->with('success', 'Materia actualizada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error actualizando materia: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error actualizando materia: ' . $e->getMessage()]);
        }
    }

    // Eliminar una materia de la base de datos
    public function destroy(Materia $materia)
    {
        try {
            $materia->delete();
            return redirect()->route('materias.index')
                             ->with('success', 'Materia eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error eliminando materia: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error eliminando materia: ' . $e->getMessage()]);
        }
    }
}
