<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soporte;
use App\Models\Bodega;
use App\Models\Caja;
use App\Models\DificultadSoporte;
use App\Models\EstadoSoporte;
use App\Models\TipoSoporte;

class SoporteController extends Controller
{
    // Mostrar la lista de soportes
    public function index()
    {
        $soportes = Soporte::orderBy('created_at', 'desc')->paginate(10);
        return view('soportes.index', compact('soportes'));
    }

    // Mostrar el formulario para crear un nuevo soporte
    public function create()
    {
        $bodegas = Bodega::all();
        $cajas = Caja::all();
        $dificultades = DificultadSoporte::all();
        $estados = EstadoSoporte::all();
        $tipos = TipoSoporte::all();

        return view('soportes.create', compact('bodegas', 'cajas', 'dificultades', 'estados', 'tipos'));
    }

    // Almacenar un nuevo soporte en la base de datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bodega_id' => 'required|exists:bodegas,id',
            'caja_id' => 'required|exists:cajas,id',
            'dificultad_soporte_id' => 'required|exists:dificultades_soporte,id',
            'estado_soporte_id' => 'required|exists:estados_soporte,id',
            'tipo_soporte_id' => 'required|exists:tipos_soporte,id',
            'descripcion' => 'required|string|max:4000',
            'solucion' => 'nullable|string|max:4000',
            'horas_hombre' => 'nullable|numeric',
            'uf' => 'nullable|numeric',
            'celular' => 'required|string|max:12',
            'email' => 'required|email|max:45',
            'urgente' => 'sometimes|boolean',
        ]);
    
        // Crear el soporte
        $soporte = new Soporte($validatedData);
        $soporte->urgente = $request->has('urgente');
        $soporte->save();
    
        // Retornar el soporte_id en la respuesta JSON
        return response()->json(['success' => true, 'soporte_id' => $soporte->id]);
    }
    

    // Mostrar detalles de un soporte específico
    public function show($id)
    {
        $soporte = Soporte::findOrFail($id);
        return view('soportes.show', compact('soporte'));
    }

    // Mostrar el formulario para editar un soporte existente
    public function edit($id)
    {
        $soporte = Soporte::findOrFail($id);
        $bodegas = Bodega::all();
        $cajas = Caja::all();
        $dificultades = DificultadSoporte::all();
        $estados = EstadoSoporte::all();
        $tipos = TipoSoporte::all();

        return view('soportes.edit', compact('soporte', 'bodegas', 'cajas', 'dificultades', 'estados', 'tipos'));
    }

    // Actualizar un soporte existente en la base de datos
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'horas_hombre' => 'nullable|numeric',
            'uf' => 'nullable|numeric',
            'descripcion' => 'nullable|string|max:4000',
            'solucion' => 'nullable|string|max:4000',
            'celular' => 'nullable|string|max:12',
            'email' => 'nullable|email|max:45',
            'urgente' => 'sometimes|boolean',
            'bodega_id' => 'required|exists:bodegas,id',
            'caja_id' => 'required|exists:cajas,id',
            'dificultad_soporte_id' => 'required|exists:dificultades_soporte,id',
            'estado_soporte_id' => 'required|exists:estados_soporte,id',
            'tipo_soporte_id' => 'required|exists:tipos_soporte,id',
        ]);

        $soporte = Soporte::findOrFail($id);
        $soporte->fill($validatedData);
        $soporte->urgente = $request->has('urgente');
        $soporte->save();

        return redirect()->route('soportes.index')->with('success', 'Soporte actualizado exitosamente.');
    }

    // Eliminar un soporte de la base de datos
    public function destroy($id)
    {
        $soporte = Soporte::findOrFail($id);
        $soporte->delete();

        return redirect()->route('soportes.index')->with('success', 'Soporte eliminado exitosamente.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // Ajusta las validaciones según tus necesidades
            'soporte_id' => 'required|exists:soportes,id',
        ]);

        $soporte = Soporte::findOrFail($request->input('soporte_id')); // Asegúrate de recibir el ID del soporte

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $path = $image->store('soportes', 'public'); // Almacena la imagen en 'storage/app/public/soportes'

            // Crea una nueva instancia de SoporteImagen
            SoporteImagen::create([
                'soporte_id' => $soporte->id,
                'ruta' => $path,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Imagen subida exitosamente.']);
    }

}
