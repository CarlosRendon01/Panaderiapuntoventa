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
       // Validación
       $request->validate([
           'nombre' => 'required|string|max:255',
           'descripcion' => 'required|string',
           'proveedor' => 'required|string|max:255',
           'cantidad' => 'required|numeric|min:0',  // Asegura que no sean negativos
           'precio' => 'required|numeric|min:0',   // Asegura que no sean negativos
           'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
   
       // Manejo de la imagen
       $imagenUrl = null;
       if ($request->hasFile('imagen')) {
           $imagen = $request->file('imagen');
           $imagenUrl = $imagen->store('imagenes_materia', 'public');
       }
   
       DB::beginTransaction();
       try {
           // Crear la materia directamente especificando cada campo
           $materia = Materia::create([
               'nombre' => $request->nombre,
               'descripcion' => $request->descripcion,
               'proveedor' => $request->proveedor,
               'cantidad' => $request->cantidad,
               'precio' => $request->precio,
               'imagen_url' => $imagenUrl
           ]);
   
           DB::commit();
           return redirect()->route('materias.index')->with('success', 'Materia creada exitosamente.');
       } catch (\Exception $e) {
           DB::rollback();
           return back()->withErrors(['error' => 'Ocurrió un error al crear la materia: ' . $e->getMessage()])->withInput();
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
