<?php

namespace App\Http\Controllers;

use App\Models\HistorialEstado;
use Illuminate\Http\Request;
use App\Models\Soporte;
use App\Models\Bodega;
use App\Models\Caja;
use App\Models\Conversation;
use App\Models\DificultadSoporte;
use App\Models\EstadoCobranza;
use App\Models\EstadoSoporte;
use App\Models\Message;
use App\Models\TipoSoporte;
use App\Models\SoporteImagen;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SoporteController
{
    // Mostrar la lista de soportes
    public function index()
    {
        // Recuperar los soportes con la relación EstadoSoporte
        $soportes = Soporte::with('estadoSoporte')
            // Realizar un join con la tabla estado_soportes para ordenar por 'orden'
            ->join('estado_soportes', 'soportes.estado_soporte_id', '=', 'estado_soportes.id')
            // Ordenar primero por fecha de creación ascendente (más antiguo primero)
            ->orderBy('soportes.created_at', 'asc')
            // Luego ordenar por el campo 'orden' de estado_soportes ascendente (Pendiente primero)
            ->orderBy('estado_soportes.orden', 'asc')
            // Seleccionar solo los campos de soportes para evitar conflictos
            ->select('soportes.*')
            // Paginación de 10 elementos por página
            ->paginate(10);
            
        return view('soportes.index', compact('soportes'));
    }

    // Mostrar el formulario para crear un nuevo soporte
    public function create()
    {
        return view('soportes.create');
    }

    // Almacenar un nuevo soporte en la base de datos
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $sucursal = $user->sucursal;
            $bodega = $user->bodega;
            $caja = $user->caja;

            // Si urgente no se marca en el formulario este será false
            $request->merge([
                'urgente' => $request->has('urgente') ? true : false,
            ]);

            // Validación de datos base para todos los roles
            if ($user->hasRole('Cliente')) {
                $validatedData = $request->validate([
                    'celular' => 'required|string|max:12',
                    'email' => 'required|email|max:45',
                    'descripcion' => 'required|string|max:4000',
                    'urgente' => 'sometimes|boolean',
                    'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
            }

            // Validación adicional si el usuario es Administrador
            if ($user->hasRole('Administrador')) {
                $validatedData = array_merge($validatedData ?? [], $request->validate([
                    'bodega_id' => 'required|exists:bodegas,id',
                    'caja_id' => 'required|exists:cajas,id',
                    'dificultad_soporte_id' => 'required|exists:dificultades_soporte,id',
                    'estado_soporte_id' => 'required|exists:estados_soporte,id',
                    'tipo_soporte_id' => 'required|exists:tipos_soporte,id',
                    'solucion' => 'nullable|string|max:4000',
                    'horas_hombre' => 'nullable|numeric',
                    'uf' => 'nullable|numeric',
                ]));
            }

            // Crear el soporte
            $soporte = new Soporte();
            $soporte->id = Str::uuid()->toString();
            $soporte->estado_soporte_id = EstadoSoporte::where('nombre', 'PENDIENTE')->first()->id;
            $soporte->descripcion = $request->input('descripcion');
            $soporte->celular = $request->input('celular');
            $soporte->email = $request->input('email');
            $soporte->urgente = $request->input('urgente');
            $soporte->bodega_id = $bodega ? $bodega->id : null;
            $soporte->caja_id = $caja ? $caja->id : null;
            $soporte->sucursal_id = $sucursal ? $sucursal->id : null;

            $soporte->save();

            // Crear el Historial del Estado
            $historialEstado = new HistorialEstado();
            $historialEstado->id = Str::uuid()->toString();
            $historialEstado->soporte_id = $soporte->id;
            $historialEstado->estado_soporte_id = $soporte->estado_soporte_id;
            $historialEstado->usuario_id = $user->id;
            
            $historialEstado->save();

            // Guardar las imágenes del soporte
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imagen) {
                    $path = $imagen->store('soportes', 'public');

                    SoporteImagen::create([
                        'soporte_id' => $soporte->id,
                        'ruta' => $path,
                    ]);
                }
            }

            // Retornar el resultado del soporte creado
            return response()->json([
                'success' => true,
                'soporte' => $soporte,
                'imagenes' => $soporte->imagenes,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al crear el soporte. Por favor, inténtalo de nuevo.', 'error' => $e->getMessage()], 500);
        }
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
        $estadosSoporte = EstadoSoporte::orderBy('orden')->get();
        $estadoSoporteSelect = EstadoSoporte::where('nombre','Cerrado')->orWhere('nombre','En Desarrollo')->orWhere('nombre','Abierto')->orderBy('nombre')->get();
        $tipos = TipoSoporte::all();
        $estadosCobranza = EstadoCobranza::all();
        $conversation = Conversation::where('soporte_id', $soporte->id)->first();
        $messages = Message::where('conversation_id', $conversation->id)->orderBy('created_at')->get();
        
        $historialEstados = HistorialEstado::where('soporte_id', $soporte->id)->get();
        $estadoPendiente = EstadoSoporte::where('nombre', 'PENDIENTE')->first();

        if($historialEstados->count() < 2){
            //insertar historial estado con el usuario logeado estado_soporte_id ABIERTO y actualizar el estado_id del soporte a ABIERTO tambien
            $estadoAbierto = EstadoSoporte::where('nombre', 'ABIERTO')->first();

            // Actualizar estado soporte
            $soporte->estado_soporte_id = $estadoAbierto->id;
            $soporte->save();

            // Crear nuevo registro del estado historico del soporte
            HistorialEstado::create([
                'id' => Str::uuid()->toString(),
                'soporte_id' => $soporte->id,
                'estado_soporte_id' => $estadoAbierto->id,
                'usuario_id' => Auth::id(),
            ]);
        }

        $historialEstados = HistorialEstado::where('soporte_id', $soporte->id)->get();

        $id_creador_soporte = HistorialEstado::where('soporte_id', $soporte->id)->where('estado_soporte_id', $estadoPendiente->id)->first()->usuario_id;
        $creador_soporte = Usuario::find($id_creador_soporte);

        return view('soportes.edit', compact('soporte', 'bodegas', 'cajas', 'dificultades', 'estadosSoporte', 'estadosCobranza', 'tipos', 'messages', 'creador_soporte', 'historialEstados', 'estadoSoporteSelect'));
    }

    // Actualizar un soporte existente en la base de datos
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'horas_hombre' => 'nullable|numeric',
            'uf' => 'nullable|numeric',
            'fecha_estimada_entrega' => 'required|nullable|date',
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

        //insertar historial estado con el usuario logeado estado_soporte_id ABIERTO y actualizar el estado_id del soporte a ABIERTO tambien
        $estadoAbierto = EstadoSoporte::where('nombre', 'En Desarrollo')->first();

        // Actualizar estado soporte
        $soporte->estado_soporte_id = $estadoAbierto->id;
        $soporte->save();

        // Crear nuevo registro del estado historico del soporte
        HistorialEstado::create([
            'id' => Str::uuid()->toString(),
            'soporte_id' => $soporte->id,
            'estado_soporte_id' => $estadoAbierto->id,
            'usuario_id' => Auth::id(),
        ]);


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
