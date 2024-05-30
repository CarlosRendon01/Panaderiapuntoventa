<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-ventas', ['only' => ['index', 'show']]);
        $this->middleware('permission:crear-ventas', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-ventas', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-ventas', ['only' => ['destroy']]);
    }    

    public function index()
    {
        $ventas = Venta::paginate(300);
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        return view('ventas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'total' => 'required|numeric',
        ]);

        Venta::create($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    }

    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        return view('ventas.editar', compact('venta'));
    }

    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'total' => 'required|numeric',
        ]);

        $venta->update($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
