<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.crear');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric|between:0,9999.99',
            'cantidad' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Manejar la carga de la imagen
        $imagenUrl = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenUrl = $imagen->store('imagenes_productos', 'public');
        }

        // Crear el producto
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'imagen_url' => $imagenUrl,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.editar', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric|between:0,9999.99',
            'cantidad' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $producto = Producto::findOrFail($id);

        // Manejar la carga de la nueva imagen si es proporcionada
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen antigua si existe
            if ($producto->imagen_url) {
                Storage::disk('public')->delete($producto->imagen_url);
            }

            $imagen = $request->file('imagen');
            $imagenUrl = $imagen->store('imagenes_productos', 'public');
        } else {
            $imagenUrl = $producto->imagen_url;
        }

        // Actualizar el producto
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'imagen_url' => $imagenUrl,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);

            // Eliminar la imagen si existe
            if ($producto->imagen_url) {
                Storage::disk('public')->delete($producto->imagen_url);
            }

            $producto->delete();
            return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error eliminando producto: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error eliminando producto: ' . $e->getMessage()]);
        }
    }
}
