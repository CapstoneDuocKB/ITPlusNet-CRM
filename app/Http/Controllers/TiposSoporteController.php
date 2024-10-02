<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoSoporte;
use Illuminate\Support\Str;

class TiposSoporteController extends Controller
{
    // Mostrar la lista de tipos de soporte
    public function index()
    {
        $tipos_soporte = TipoSoporte::all();
        return view('tipos_soporte.index', compact('tipos_soporte'));
    }

    // Mostrar el formulario para crear un nuevo tipo de soporte
    public function create()
    {
        return view('tipos_soporte.create');
    }

    // Almacenar un nuevo tipo de soporte en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);

        $tipo_soporte = new TipoSoporte();
        $tipo_soporte->id = Str::uuid(); // Generar un UUID para el ID
        $tipo_soporte->nombre = $request->nombre;
        $tipo_soporte->descripcion = $request->descripcion;
        $tipo_soporte->save();

        return redirect()->route('tipos_soporte.index')->with('success', 'Tipo de soporte creado exitosamente.');
    }

    // Mostrar detalles de un tipo de soporte específico
    public function show($id)
    {
        $tipo_soporte = TipoSoporte::findOrFail($id);
        return view('tipos_soporte.show', compact('tipo_soporte'));
    }

    // Mostrar el formulario para editar un tipo de soporte existente
    public function edit($id)
    {
        $tipo_soporte = TipoSoporte::findOrFail($id);
        return view('tipos_soporte.edit', compact('tipo_soporte'));
    }

    // Actualizar un tipo de soporte existente en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);

        $tipo_soporte = TipoSoporte::findOrFail($id);
        $tipo_soporte->nombre = $request->nombre;
        $tipo_soporte->descripcion = $request->descripcion;
        $tipo_soporte->save();

        return redirect()->route('tipos_soporte.index')->with('success', 'Tipo de soporte actualizado exitosamente.');
    }

    // Eliminar un tipo de soporte de la base de datos
    public function destroy($id)
    {
        $tipo_soporte = TipoSoporte::findOrFail($id);
        $tipo_soporte->delete();

        return redirect()->route('tipos_soporte.index')->with('success', 'Tipo de soporte eliminado exitosamente.');
    }
}
