<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use App\Models\Bodega;
use App\Models\Caja;
use Illuminate\Http\Request;

class SoporteController extends Controller
{
    /**
     * Muestra la vista del formulario para crear un soporte.
     */
    public function create()
    {
        // Obtener bodegas y cajas para los select del formulario
        $bodegas = Bodega::all();
        $cajas = Caja::all();

        return view('soportes.create', compact('bodegas', 'cajas'));
    }

    /**
     * Almacena el nuevo soporte en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos ingresados
        $request->validate([
            'bodega_id' => 'required|exists:bodegas,id',
            'caja_id' => 'required|exists:cajas,id',
            'descripcion' => 'required|string|max:4000',
            'celular' => 'required|string|max:12',
            'email' => 'required|email|max:45',
            'urgente' => 'nullable|boolean',
        ]);

        // Crear un nuevo soporte con los datos validados
        Soporte::create([
            'bodega_id' => $request->bodega_id,
            'caja_id' => $request->caja_id,
            'descripcion' => $request->descripcion,
            'celular' => $request->celular,
            'email' => $request->email,
            'urgente' => $request->urgente ? 1 : 0, // Si se marcó como urgente
        ]);

        // Redirigir al listado de soportes con un mensaje de éxito
        return redirect()->route('soportes.index')->with('success', 'Soporte creado exitosamente.');
    }

    /**
     * Muestra un listado de todos los soportes (opcional según tus necesidades).
     */
    public function index()
    {
        $soportes = Soporte::all();
        return view('soportes.index', compact('soportes'));
    }
}
