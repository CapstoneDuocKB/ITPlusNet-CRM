<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoSoporte;
use Illuminate\Support\Str;

class EstadosSoporteController extends Controller
{
    // Mostrar la lista de estados de soporte
    public function index()
    {
        $estados_soporte = EstadoSoporte::all();
        return view('estados_soporte.index', compact('estados_soporte'));
    }

    // Mostrar el formulario para crear un nuevo estado de soporte
    public function create()
    {
        return view('estados_soporte.create');
    }

    // Almacenar un nuevo estado de soporte en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);

        $estado_soporte = new EstadoSoporte();
        $estado_soporte->id = Str::uuid(); // Generar un UUID para el ID
        $estado_soporte->nombre = $request->nombre;
        $estado_soporte->descripcion = $request->descripcion;
        $estado_soporte->save();

        return redirect()->route('estados_soporte.index')->with('success', 'Estado de soporte creado exitosamente.');
    }

    // Mostrar detalles de un estado de soporte específico
    public function show($id)
    {
        $estado_soporte = EstadoSoporte::findOrFail($id);
        return view('estados_soporte.show', compact('estado_soporte'));
    }

    // Mostrar el formulario para editar un estado de soporte existente
    public function edit($id)
    {
        $estado_soporte = EstadoSoporte::findOrFail($id);
        return view('estados_soporte.edit', compact('estado_soporte'));
    }

    // Actualizar un estado de soporte existente en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);

        $estado_soporte = EstadoSoporte::findOrFail($id);
        $estado_soporte->nombre = $request->nombre;
        $estado_soporte->descripcion = $request->descripcion;
        $estado_soporte->save();

        return redirect()->route('estados_soporte.index')->with('success', 'El Estado de Soporte se ha actualizado exitosamente.');
    }

    // Eliminar un estado de soporte de la base de datos
    public function destroy($id)
    {
        $estado_soporte = EstadoSoporte::findOrFail($id);
        $estado_soporte->delete();

        return redirect()->route('estados_soporte.index')->with('success', 'El Estado de Soporte se ha eliminado exitosamente.');
    }
}
