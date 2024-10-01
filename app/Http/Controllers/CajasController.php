<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use Illuminate\Support\Str;

class CajasController extends Controller
{
    // Mostrar la lista de cajas
    public function index()
    {
        $cajas = Caja::all();
        return view('cajas.index', compact('cajas'));
    }

    // Mostrar el formulario para crear una nueva caja
    public function create()
    {
        return view('cajas.create');
    }

    // Almacenar una nueva caja en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'activa' => 'sometimes|boolean',
            'sucursal_id' => 'nullable|exists:sucursales,id',
        ]);

        $caja = new Caja();
        $caja->id = Str::uuid(); // Generar un UUID para el ID
        $caja->nombre = $request->nombre;
        $caja->activa = $request->has('activa');
        $caja->sucursal_id = $request->sucursal_id;
        $caja->save();

        return redirect()->route('cajas.index')->with('success', 'Caja creada exitosamente.');
    }

    // Mostrar detalles de una caja específica
    public function show($id)
    {
        $caja = Caja::findOrFail($id);
        return view('cajas.show', compact('caja'));
    }

    // Mostrar el formulario para editar una caja existente
    public function edit($id)
    {
        $caja = Caja::findOrFail($id);
        return view('cajas.edit', compact('caja'));
    }

    // Actualizar una caja existente en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'activa' => 'sometimes|boolean',
            'sucursal_id' => 'nullable|exists:sucursales,id',
        ]);

        $caja = Caja::findOrFail($id);
        $caja->nombre = $request->nombre;
        $caja->activa = $request->has('activa');
        $caja->sucursal_id = $request->sucursal_id;
        $caja->save();

        return redirect()->route('cajas.index')->with('success', 'Caja actualizada exitosamente.');
    }

    // Eliminar una caja de la base de datos
    public function destroy($id)
    {
        $caja = Caja::findOrFail($id);
        $caja->delete();

        return redirect()->route('cajas.index')->with('success', 'Caja eliminada exitosamente.');
    }
}
