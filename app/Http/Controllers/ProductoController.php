<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Muestra una lista de productos
    public function index()
    {
        $productos = Producto::paginate(10);
        return view('productos.index', compact('productos'));
    }

    // Muestra el formulario para crear un nuevo producto
    public function create()
    {
        return view('productos.crear');
    }

    // Almacena un nuevo producto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        $producto = Producto::create($request->all());

        // Verifica si $producto->id_producto es null
        if ($producto->id_producto === null) {
            throw new \Exception('Error: id_producto is null in store method');
        }

        // Log the action
       

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    // Muestra un producto específico
    public function show($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        return view('productos.show', compact('producto'));
    }

    // Muestra el formulario para editar un producto existente
    public function edit($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        return view('productos.editar', compact('producto'));
    }

    // Actualiza un producto existente en la base de datos
    public function update(Request $request, $id_producto)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        $producto = Producto::findOrFail($id_producto);
        $producto->update($request->all());

        // Verifica si $producto->id_producto es null
        if ($producto->id_producto === null) {
            throw new \Exception('Error: id_producto is null in update method');
        }

        // Log the action
        $executedSQL = "UPDATE productos SET id_producto = '{$producto->id_producto}', nombre = '{$producto->nombre}', descripcion = '{$producto->descripcion}', precio = '{$producto->precio}', cantidad = '{$producto->cantidad}', created_at = '{$producto->created_at}', updated_at = '{$producto->updated_at}' WHERE id_producto = '{$producto->id_producto}'";
        $reverseSQL = "UPDATE productos SET id_producto = '{$producto->id_producto}', nombre = '{$producto->getOriginal('nombre')}', descripcion = '{$producto->getOriginal('descripcion')}', precio = '{$producto->getOriginal('precio')}', cantidad = '{$producto->getOriginal('cantidad')}', created_at = '{$producto->getOriginal('created_at')}', updated_at = '{$producto->getOriginal('updated_at')}' WHERE id_producto = '{$producto->id_producto}'";
        
       

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // Elimina un producto de la base de datos
    public function destroy($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        $producto->delete();

        // Verifica si $producto->id_producto es null
        if ($producto->id_producto === null) {
            throw new \Exception('Error: id_producto is null in destroy method');
        }

        // Log the action
      

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    // Función para registrar las acciones
   
}