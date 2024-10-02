<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DificultadSoporte;
use Illuminate\Support\Str;

class DificultadesSoporteController extends Controller
{
    // Mostrar la lista de dificultades de soporte
    public function index()
    {
        $dificultades_soporte = DificultadSoporte::all();
        return view('dificultades_soporte.index', compact('dificultades_soporte'));
    }

    // Mostrar el formulario para crear una nueva dificultad de soporte
    public function create()
    {
        return view('dificultades_soporte.create');
    }

    // Almacenar una nueva dificultad de soporte en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:20',
            'descripcion' => 'nullable|max:255',
            'uf' => 'required|numeric',
        ]);

        $dificultad_soporte = new DificultadSoporte();
        $dificultad_soporte->id = Str::uuid(); // Generar un UUID para el ID
        $dificultad_soporte->nombre = $request->nombre;
        $dificultad_soporte->descripcion = $request->descripcion;
        $dificultad_soporte->uf = $request->uf;
        $dificultad_soporte->save();

        return redirect()->route('dificultades_soporte.index')->with('success', 'Dificultad de soporte creada exitosamente.');
    }

    // Mostrar detalles de una dificultad de soporte específica
    public function show($id)
    {
        $dificultad_soporte = DificultadSoporte::findOrFail($id);
        return view('dificultades_soporte.show', compact('dificultad_soporte'));
    }

    // Mostrar el formulario para editar una dificultad de soporte existente
    public function edit($id)
    {
        $dificultad_soporte = DificultadSoporte::findOrFail($id);
        return view('dificultades_soporte.edit', compact('dificultad_soporte'));
    }

    // Actualizar una dificultad de soporte existente en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:20',
            'descripcion' => 'nullable|max:255',
            'uf' => 'required|numeric',
        ]);

        $dificultad_soporte = DificultadSoporte::findOrFail($id);
        $dificultad_soporte->nombre = $request->nombre;
        $dificultad_soporte->descripcion = $request->descripcion;
        $dificultad_soporte->uf = $request->uf;
        $dificultad_soporte->save();

        return redirect()->route('dificultades_soporte.index')->with('success', 'Dificultad de soporte actualizada exitosamente.');
    }

    // Eliminar una dificultad de soporte de la base de datos
    public function destroy($id)
    {
        $dificultad_soporte = DificultadSoporte::findOrFail($id);
        $dificultad_soporte->delete();

        return redirect()->route('dificultades_soporte.index')->with('success', 'Dificultad de soporte eliminada exitosamente.');
    }
}
