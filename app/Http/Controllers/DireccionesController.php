<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\Comuna;
use Illuminate\Support\Str;

class DireccionesController extends Controller
{
    public function index()
    {
        $direcciones = Direccion::all();
        return view('direcciones.index', compact('direcciones'));
    }

    public function create()
    {
        $comunas = Comuna::all();
        return view('direcciones.create', compact('comunas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'calle' => 'required|max:255',
            'numero' => 'required|max:20',
            'comuna_id' => 'required|exists:comunas,id',
        ]);

        $direccion = new Direccion();
        $direccion->id = Str::uuid();
        $direccion->calle = $request->calle;
        $direccion->numero = $request->numero;
        $direccion->comuna_id = $request->comuna_id;
        $direccion->save();

        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección creada exitosamente.');
    }

    public function show($id)
    {
        $direccion = Direccion::findOrFail($id);
        return view('direcciones.show', compact('direccion'));
    }

    public function edit($id)
    {
        $direccion = Direccion::findOrFail($id);
        $comunas = Comuna::all();
        return view('direcciones.edit', compact('direccion', 'comunas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'calle' => 'required|max:255',
            'numero' => 'required|max:20',
            'comuna_id' => 'required|exists:comunas,id',
        ]);

        $direccion = Direccion::findOrFail($id);
        $direccion->calle = $request->calle;
        $direccion->numero = $request->numero;
        $direccion->comuna_id = $request->comuna_id;
        $direccion->save();

        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $direccion = Direccion::findOrFail($id);
        $direccion->delete();

        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección eliminada exitosamente.');
    }
}
