<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Str;

class RegionesController extends Controller
{
    // Mostrar la lista de regiones
    public function index()
    {
        $regiones = Region::all();
        return view('regiones.index', compact('regiones'));
    }

    // Mostrar el formulario para crear una nueva región
    public function create()
    {
        return view('regiones.create');
    }

    // Almacenar una nueva región en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        $region = new Region();
        $region->id = Str::uuid(); // Generar un UUID para el ID
        $region->nombre = $request->nombre;
        $region->save();

        return redirect()->route('regiones.index')->with('success', 'Región creada exitosamente.');
    }

    // Mostrar detalles de una región específica
    public function show($id)
    {
        $region = Region::findOrFail($id);
        return view('regiones.show', compact('region'));
    }

    // Mostrar el formulario para editar una región existente
    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('regiones.edit', compact('region'));
    }

    // Actualizar una región existente en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        $region = Region::findOrFail($id);
        $region->nombre = $request->nombre;
        $region->save();

        return redirect()->route('regiones.index')->with('success', 'Región actualizada exitosamente.');
    }

    // Eliminar una región de la base de datos
    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        return redirect()->route('regiones.index')->with('success', 'Región eliminada exitosamente.');
    }
}
