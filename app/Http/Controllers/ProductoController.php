<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Materiaprima; 
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index()
    {
        $productos = Producto::paginate(10);
        return view('productos.index', compact('productos'));
    }


    public function create()
    {
        $materiasPrimas = Materiaprima::all();
        return view('productos.crear', compact('materiasPrimas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric|between:0,9999.99',
            'cantidad' => 'required|integer',
            'materias_primas' => 'required|array',
            'cantidades' => 'required|array',
            'cantidades.*' => 'integer|min:0',
        ]);
    
        // Crear una descripción de las materias primas
        $materiasPrimasDescripcion = '';

        foreach ($request->materias_primas as $index => $materia_prima_id) {
            $cantidad = $request->cantidades[$index];
            $materiaPrima = Materiaprima::findOrFail($materia_prima_id);
            $materiasPrimasDescripcion .= $materiaPrima->nombre . ': ' . $cantidad . ', ';
        }
    
        if ($materiasPrimasDescripcion !== '') {
            $materiasPrimasDescripcion = rtrim($materiasPrimasDescripcion, ', ');
        }
    
        // Crear el producto con la descripción de materias primas
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'materia_prima' => $materiasPrimasDescripcion
        ]);



        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }


    public function show($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        return view('productos.show', compact('producto'));
    }


    public function edit($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $materiasPrimas = Materiaprima::all();
        return view('productos.editar', compact('producto', 'materiasPrimas'));
    }


    public function update(Request $request, $id_producto)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'materias_primas' => 'required|array',
            'cantidades' => 'required|array',
            'cantidades.*' => 'integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            $producto = Producto::findOrFail($id_producto);
            $producto->update($request->only('nombre', 'descripcion', 'precio', 'cantidad'));
            $producto->materiasPrimas()->detach();

            foreach ($request->materias_primas as $index => $materia_prima_id) {
                $cantidad = $request->cantidades[$index];
                $materiaPrima = Materiaprima::findOrFail($materia_prima_id);
                
                if ($materiaPrima->cantidad < $cantidad) {
                    throw new \Exception('Cantidad insuficiente de materia prima: ' . $materiaPrima->nombre);
                }

                $materiaPrima->cantidad -= $cantidad;
                $materiaPrima->save();

                $producto->materiasPrimas()->attach($materia_prima_id, ['cantidad' => $cantidad]);
            }

            DB::commit();
            return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error actualizando producto: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error actualizando producto: ' . $e->getMessage()]);
        }
    }

// ProductoController.php

public function updateCantidad(Request $request, $id)
{
    $producto = Producto::findOrFail($id);
    $materiaPrima = Materiaprima::findOrFail($producto->materia_prima_id); // Supongamos que cada producto tiene un ID de materia prima asociado
    
    // Calcula la cantidad necesaria de materia prima para la cantidad ingresada
    $cantidadNecesaria = $request->input('cantidad') * $producto->cantidad_por_producto;

    if ($materiaPrima->cantidad >= $cantidadNecesaria) {
        $producto->cantidad += $request->input('cantidad');
        $materiaPrima->cantidad -= $cantidadNecesaria;

        $producto->save();
        $materiaPrima->save();

        return response()->json(['success' => true, 'cantidad' => $producto->cantidad, 'materia_prima' => $materiaPrima->cantidad]);
    } else {
        return response()->json(['success' => false, 'message' => 'No hay suficiente materia prima disponible.']);
    }
}
    public function destroy($id_producto)
    {
        try {
            $producto = Producto::findOrFail($id_producto);
            $producto->delete();
            return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error eliminando producto: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error eliminando producto: ' . $e->getMessage()]);
        }
    }
}