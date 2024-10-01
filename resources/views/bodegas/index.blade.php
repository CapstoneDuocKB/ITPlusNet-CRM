<!-- resources/views/bodegas/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Bodegas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('bodegas.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                Crear Nueva Bodega
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
                            <th class="px-6 py-3 border-b">Nombre</th>
                            <th class="px-6 py-3 border-b">Activa</th>
                            <th class="px-6 py-3 border-b">Sucursal ID</th>
                            <th class="px-6 py-3 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bodegas as $bodega)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $bodega->id }}</td>
                            <td class="px-6 py-4 border-b">{{ $bodega->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $bodega->activa ? 'Sí' : 'No' }}</td>
                            <td class="px-6 py-4 border-b">{{ $bodega->sucursal->nombre ?? 'Sin Sucursal' }}</td>
                            <td class="px-6 py-4 border-b">
                                <a href="{{ route('bodegas.show', $bodega->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                                <a href="{{ route('bodegas.edit', $bodega->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a> |
                                <form action="{{ route('bodegas.destroy', $bodega->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta bodega?')" class="text-red-600 hover:text-red-900">Eliminar</button>
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
