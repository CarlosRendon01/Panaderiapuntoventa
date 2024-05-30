<?php

namespace App\Http\Controllers;

use App\Models\Materiaprima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MateriaController extends Controller
{

    public function index()
    {
        $materias = Materia::paginate(10);
        return view('materias.index', compact('materias'));
    }


    public function create()
    {
        return view('materias.crear');
    }


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
                             ->with('success', 'Materia Prima creada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error creando materia prima: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error creando materia prima: ' . $e->getMessage()]);
        }
    }


    public function show(Materia $materia)
    {
        return view('materias.show', compact('materias'));
    }


    public function edit($id_materiaprima)
    {
        $materiaprima = Materiaprima::findOrFail($id_materiaprima);
        return view('materiaprimas.editar', compact('materias'));
    }


    public function update(Request $request, $id_materiaprima)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'nombreproveedor' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric'
        ]);

        try {
            $materiaprima = Materiaprima::findOrFail($id_materiaprima);
            $materiaprima->update($validatedData);

            return redirect()->route('materiaprimas.index')
                             ->with('success', 'Materia Prima actualizada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error actualizando materia prima: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error actualizando materia prima: ' . $e->getMessage()]);
        }
    }


    public function destroy($id_materiaprima)
    {
        try {
            $materiaprima = Materiaprima::findOrFail($id_materiaprima);
            $materiaprima->delete();
            return redirect()->route('materiaprimas.index')
                             ->with('success', 'Materia Prima eliminada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error eliminando materia prima: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error eliminando materia prima: ' . $e->getMessage()]);
        }
    }
}

