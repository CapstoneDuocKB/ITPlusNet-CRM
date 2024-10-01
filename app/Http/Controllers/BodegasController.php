<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;
use Illuminate\Support\Str;

class BodegasController extends Controller
{
    // Mostrar la lista de bodegas
    public function index()
    {
        $bodegas = Bodega::all();
        return view('bodegas.index', compact('bodegas'));
    }

    // Mostrar el formulario para crear una nueva bodega
    public function create()
    {
        return view('bodegas.create');
    }

    // Almacenar una nueva bodega en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'activa' => 'sometimes|boolean',
            'sucursal_id' => 'nullable|exists:sucursales,id',
        ]);

        $bodega = new Bodega();
        $bodega->id = Str::uuid(); // Generar un UUID para el ID
        $bodega->nombre = $request->nombre;
        $bodega->activa = $request->has('activa');
        $bodega->sucursal_id = $request->sucursal_id;
        $bodega->save();

        return redirect()->route('bodegas.index')->with('success', 'Bodega creada exitosamente.');
    }

    // Mostrar detalles de una bodega específica
    public function show($id)
    {
        $bodega = Bodega::findOrFail($id);
        return view('bodegas.show', compact('bodega'));
    }

    // Mostrar el formulario para editar una bodega existente
    public function edit($id)
    {
        $bodega = Bodega::findOrFail($id);
        return view('bodegas.edit', compact('bodega'));
    }

    // Actualizar una bodega existente en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'activa' => 'sometimes|boolean',
            'sucursal_id' => 'nullable|exists:sucursales,id',
        ]);

        $bodega = Bodega::findOrFail($id);
        $bodega->nombre = $request->nombre;
        $bodega->activa = $request->has('activa');
        $bodega->sucursal_id = $request->sucursal_id;
        $bodega->save();

        return redirect()->route('bodegas.index')->with('success', 'Bodega actualizada exitosamente.');
    }

    // Eliminar una bodega de la base de datos
    public function destroy($id)
    {
        $bodega = Bodega::findOrFail($id);
        $bodega->delete();

        return redirect()->route('bodegas.index')->with('success', 'Bodega eliminada exitosamente.');
    }
}
