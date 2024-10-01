<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Direccion;
use App\Models\Empresa;
use Illuminate\Support\Str;

class SucursalesController extends Controller
{
    // Mostrar la lista de sucursales
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('sucursales.index', compact('sucursales'));
    }

    // Mostrar el formulario para crear una nueva sucursal
    public function create()
    {
        $direcciones = Direccion::all();
        $empresas = Empresa::all();
        $sucursales = Sucursal::all(); // Para seleccionar sucursal padre si aplica

        return view('sucursales.create', compact('direcciones', 'empresas', 'sucursales'));
    }

    // Almacenar una nueva sucursal en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'activa' => 'sometimes|boolean',
            'direccion_id' => 'nullable|exists:direcciones,id',
            'sucursal_id' => 'nullable|exists:sucursales,id',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $sucursal = new Sucursal();
        $sucursal->id = Str::uuid(); // Generar un UUID para el ID
        $sucursal->nombre = $request->nombre;
        $sucursal->activa = $request->has('activa');
        $sucursal->direccion_id = $request->direccion_id;
        $sucursal->sucursal_id = $request->sucursal_id;
        $sucursal->empresa_id = $request->empresa_id;
        $sucursal->save();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal creada exitosamente.');
    }

    // Mostrar detalles de una sucursal específica
    public function show($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('sucursales.show', compact('sucursal'));
    }

    // Mostrar el formulario para editar una sucursal existente
    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $direcciones = Direccion::all();
        $empresas = Empresa::all();
        $sucursales = Sucursal::where('id', '!=', $id)->get(); // Excluir la sucursal actual

        return view('sucursales.edit', compact('sucursal', 'direcciones', 'empresas', 'sucursales'));
    }

    // Actualizar una sucursal existente en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'activa' => 'sometimes|boolean',
            'direccion_id' => 'nullable|exists:direcciones,id',
            'sucursal_id' => 'nullable|exists:sucursales,id',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        $sucursal = Sucursal::findOrFail($id);
        $sucursal->nombre = $request->nombre;
        $sucursal->activa = $request->has('activa');
        $sucursal->direccion_id = $request->direccion_id;
        $sucursal->sucursal_id = $request->sucursal_id;
        $sucursal->empresa_id = $request->empresa_id;
        $sucursal->save();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizada exitosamente.');
    }

    // Eliminar una sucursal de la base de datos
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->delete();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal eliminada exitosamente.');
    }
}
