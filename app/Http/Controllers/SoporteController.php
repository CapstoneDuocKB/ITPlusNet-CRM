<?php

namespace App\Http\Controllers;

use App\Models\Soporte;
use App\Models\SoporteImagen;
use App\Models\Bodega;
use App\Models\Caja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
    public function read()
    {
        // Obtener los soportes paginados, por ejemplo 10 soportes por página
        $soportes = Soporte::paginate(10);
    
        // Retornar la vista read.blade.php con los soportes paginados
        return view('soportes.read', compact('soportes'));
    }
    


    // public function upload(Request $request)
    // {
    //     // dump($request->all()); // Esto detendrá la ejecución y mostrará el contenido de $request

    
    //     try {
    //         if ($request->hasFile('file')) {
    //             $file = $request->file('file');
    //             $filename = time() . '_' . $file->getClientOriginalName();
                
    //             $path = $file->storeAs('uploads', $filename, 'public'); // Guardar en la carpeta /storage/app/public/uploads
    
    //             return response()->json(['path' => $path], 200);
    //         }
    
    //         return response()->json(['message' => 'No file uploaded'], 400);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    /**
     * Almacena el nuevo soporte en la base de datos, incluyendo las imágenes subidas.
*/public function store(Request $request)
{
    // Validar los datos del formulario incluyendo las imágenes
    $request->validate([
        'bodega_id' => 'required|exists:bodegas,id',
        'caja_id' => 'required|exists:cajas,id',
        'descripcion' => 'required|string|max:4000',
        'celular' => 'required|string|max:12',
        'email' => 'required|email|max:45',
        'urgente' => 'nullable|boolean',
        'file.*' => 'sometimes|image|max:2048', // Validación para múltiples archivos (arreglo de imágenes)
    ], [
        'bodega_id.required' => 'La bodega es obligatoria.',
        'caja_id.required' => 'La caja es obligatoria.',
        'file.*.image' => 'Cada archivo debe ser una imagen.',
        'file.*.max' => 'Cada imagen no debe ser mayor de 2MB.'
    ]);

    // Crear el soporte con los datos validados
    $soporte = Soporte::create([
        'bodega_id' => $request->bodega_id,
        'caja_id' => $request->caja_id,
        'descripcion' => $request->descripcion,
        'celular' => $request->celular,
        'email' => $request->email,
        'urgente' => $request->urgente ? 1 : 0,
    ]);

    // Procesar las imágenes, si es que se subieron
    if ($request->hasFile('file')) {
        foreach ($request->file('file') as $file) {
            // Generar el nombre de archivo único
            $filename = time() . '_' . $file->getClientOriginalName();
            // Guardar el archivo en el disco 'public' en la carpeta 'uploads'
            $path = $file->storeAs('uploads', $filename, 'public');

            // Crear un nuevo registro de SoporteImagen en la base de datos
            SoporteImagen::create([
                'soporte_id' => $soporte->id,
                'ruta_imagen' => $path,
            ]);
        }
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
