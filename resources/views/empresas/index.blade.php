<!-- resources/views/empresas/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Empresas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('empresas.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                Crear Nueva Empresa
            </a>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b">ID</th>
                            <th class="px-6 py-3 border-b">RUT</th>
                            <th class="px-6 py-3 border-b">Nombre</th>
                            <th class="px-6 py-3 border-b">Razón Social</th>
                            <th class="px-6 py-3 border-b">Dirección ID</th>
                            <th class="px-6 py-3 border-b">Color</th>
                            <th class="px-6 py-3 border-b">Activa</th>
                            <th class="px-6 py-3 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empresas as $empresa)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $empresa->id }}</td>
                            <td class="px-6 py-4 border-b">{{ $empresa->rut }}</td>
                            <td class="px-6 py-4 border-b">{{ $empresa->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $empresa->razon_social }}</td>
                            <td class="px-6 py-4 border-b">{{ $empresa->direccion_id }}</td>
                            <td class="px-6 py-4 border-b">{{ $empresa->color }}</td>
                            <td class="px-6 py-4 border-b">{{ $empresa->activa ? 'Sí' : 'No' }}</td>
                            <td class="px-6 py-4 border-b">
                                <a href="{{ route('empresas.show', $empresa->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                                <a href="{{ route('empresas.edit', $empresa->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a> |
                                <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta empresa?')" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
