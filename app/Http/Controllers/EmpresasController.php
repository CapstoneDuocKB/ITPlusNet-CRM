<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Direccion;
use Illuminate\Support\Str;

class EmpresasController extends Controller
{
    // Mostrar la lista de empresas
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    // Mostrar el formulario para crear una nueva empresa
    public function create()
    {
        $direcciones = Direccion::all();
        return view('empresas.create', compact('direcciones'));
    }

    // Almacenar una nueva empresa en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'rut' => 'required|max:12|unique:empresas,rut',
            'nombre' => 'required|max:50',
            'razon_social' => 'required|max:150',
            'direccion_id' => 'required|exists:direcciones,id',
            'color' => 'required|max:20',
            'ruta_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activa' => 'sometimes|boolean',
        ]);

        $empresa = new Empresa();
        $empresa->id = Str::uuid(); // Generar un UUID para el ID
        $empresa->rut = $request->rut;
        $empresa->nombre = $request->nombre;
        $empresa->razon_social = $request->razon_social;
        $empresa->direccion_id = $request->direccion_id;
        $empresa->color = $request->color;

        if ($request->hasFile('ruta_logo')) {
            $imageName = time().'.'.$request->ruta_logo->extension();
            $request->ruta_logo->move(public_path('images'), $imageName);
            $empresa->ruta_logo = 'images/' . $imageName;
        }

        $empresa->activa = $request->has('activa');
        $empresa->save();

        return redirect()->route('empresas.index')->with('success', 'Empresa creada exitosamente.');
    }

    // Mostrar detalles de una empresa específica
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return view('empresas.show', compact('empresa'));
    }

    // Mostrar el formulario para editar una empresa existente
    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);
        $direcciones = Direccion::all();
        return view('empresas.edit', compact('empresa', 'direcciones'));
    }

    // Actualizar una empresa existente en la base de datos
    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $request->validate([
            'rut' => 'required|max:12|unique:empresas,rut,'.$empresa->id.',id',
            'nombre' => 'required|max:50',
            'razon_social' => 'required|max:150',
            'direccion_id' => 'required|exists:direcciones,id',
            'color' => 'required|max:20',
            'ruta_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'activa' => 'sometimes|boolean',
        ]);

        $empresa->rut = $request->rut;
        $empresa->nombre = $request->nombre;
        $empresa->razon_social = $request->razon_social;
        $empresa->direccion_id = $request->direccion_id;
        $empresa->color = $request->color;

        if ($request->hasFile('ruta_logo')) {
            $imageName = time().'.'.$request->ruta_logo->extension();
            $request->ruta_logo->move(public_path('images'), $imageName);
            $empresa->ruta_logo = 'images/' . $imageName;
        }

        $empresa->activa = $request->has('activa');
        $empresa->save();

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada exitosamente.');
    }

    // Eliminar una empresa de la base de datos
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();

        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada exitosamente.');
    }
}
