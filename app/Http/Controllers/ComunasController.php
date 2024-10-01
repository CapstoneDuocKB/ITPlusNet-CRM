<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Support\Str;

class ComunasController extends Controller
{
    public function index()
    {
        $comunas = Comuna::all();
        return view('comunas.index', compact('comunas'));
    }

    public function create()
    {
        $regiones = Region::all();
        return view('comunas.create', compact('regiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'region_id' => 'required|exists:regiones,id',
        ]);

        $comuna = new Comuna();
        $comuna->id = Str::uuid();
        $comuna->nombre = $request->nombre;
        $comuna->region_id = $request->region_id;
        $comuna->save();

        return redirect()->route('comunas.index')
            ->with('success', 'Comuna creada exitosamente.');
    }

    public function show($id)
    {
        $comuna = Comuna::findOrFail($id);
        return view('comunas.show', compact('comuna'));
    }

    public function edit($id)
    {
        $comuna = Comuna::findOrFail($id);
        $regiones = Region::all();
        return view('comunas.edit', compact('comuna', 'regiones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'region_id' => 'required|exists:regiones,id',
        ]);

        $comuna = Comuna::findOrFail($id);
        $comuna->nombre = $request->nombre;
        $comuna->region_id = $request->region_id;
        $comuna->save();

        return redirect()->route('comunas.index')
            ->with('success', 'Comuna actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $comuna = Comuna::findOrFail($id);
        $comuna->delete();

        return redirect()->route('comunas.index')
            ->with('success', 'Comuna eliminada exitosamente.');
    }
}
