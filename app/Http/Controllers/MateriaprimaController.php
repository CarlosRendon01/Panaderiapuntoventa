<?php

namespace App\Http\Controllers;

use App\Models\Materiaprima;
use Illuminate\Http\Request;

class MateriaprimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiaprimas = Materiaprima::paginate(10);
        return view('materiaprimas.index', compact('materiaprimas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materiaprimas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'nombreproveedor' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric'
        ]);

        Materiaprima::create($validatedData);

        return redirect()->route('materiaprimas.index')
                         ->with('success', 'Materia Prima creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materiaprima  $materiaprima
     * @return \Illuminate\Http\Response
     */
    public function show(Materiaprima $materiaprima)
    {
        return view('materiaprimas.show', compact('materiaprima'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id_materiaprima
     * @return \Illuminate\Http\Response
     */
    public function edit($id_materiaprima)
    {
        $materiaprima = Materiaprima::findOrFail($id_materiaprima);
        return view('materiaprimas.editar', compact('materiaprima'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materiaprima  $materiaprima
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_materiaprima)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'nombreproveedor' => 'required',
            'cantidad' => 'required|numeric',
            'precio' => 'required|numeric'
        ]);

        $materiaprima = Materiaprima::findOrFail($id_materiaprima);
        $materiaprima->update($request->all());

        if ($materiaprima->id_materiaprima === null) {
            throw new \Exception('Error: id_producto is null in update method');
        }

        return redirect()->route('materiaprimas.index')
                         ->with('success', 'Materia Prima actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiaprima  $materiaprima
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_materiaprima)
    {
        $materiaprima = Materiaprima::findOrFail($id_materiaprima);
        $materiaprima->delete();

        return redirect()->route('materiaprimas.index')
                         ->with('success', 'Materia Prima eliminada exitosamente.');
    }
}

