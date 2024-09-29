<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use App\Models\Bodega;
use App\Models\Caja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // Asegúrate de validar como imagen y establecer un tamaño máximo adecuado
        ]);
    
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
    
        // Guardar el archivo en un disco configurado para almacenar imágenes
        $path = $file->storeAs('uploads', $filename, 'public');
    
        // Aquí puedes decidir si deseas guardar o no la ruta del archivo en la base de datos
        // Por ejemplo, podrías guardar la ruta del archivo en una tabla de imágenes con una relación con Soporte
    
        return response()->json(['path' => $path], 200);
    }
    

    /**
     * Almacena el nuevo soporte en la base de datos, incluyendo las imágenes subidas.
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
            'file' => 'sometimes|file|image|max:2048', // Validar que el archivo sea opcional, de tipo imagen y no mayor de 2MB
        ], [
            'bodega_id.required' => 'La bodega es obligatoria.',
            'caja_id.required' => 'La caja es obligatoria.',
            'file.image' => 'El archivo debe ser una imagen.',
            'file.max' => 'La imagen no debe ser mayor de 2MB.'
        ]);
        

        // Crear un nuevo soporte con los datos validados
        $soporte = Soporte::create([
            'bodega_id' => $request->bodega_id,
            'caja_id' => $request->caja_id,
            'descripcion' => $request->descripcion,
            'celular' => $request->celular,
            'email' => $request->email,
            'urgente' => $request->urgente ? 1 : 0, // Si se marcó como urgente
        ]);

        // Procesar el archivo de imagen, si es que se subió uno
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Guardar el archivo en el sistema de archivos y asociar la ruta al soporte
            $path = $file->storeAs('uploads', $filename, 'public');
            // Actualizar el registro de soporte con la ruta del archivo (si tienes una columna para esto)
            $soporte->update(['imagen' => $path]);
        }

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
