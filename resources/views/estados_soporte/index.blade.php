<!-- resources/views/estados_soporte/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Estados de Soporte</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('estados_soporte.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                Crear Nuevo Estado de Soporte
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
                            <th class="px-6 py-3 border-b">Descripción</th>
                            <th class="px-6 py-3 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estados_soporte as $estado)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $estado->id }}</td>
                            <td class="px-6 py-4 border-b">{{ $estado->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $estado->descripcion }}</td>
                            <td class="px-6 py-4 border-b">
                                <a href="{{ route('estados_soporte.show', $estado->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                                <a href="{{ route('estados_soporte.edit', $estado->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a> |
                                <form action="{{ route('estados_soporte.destroy', $estado->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este estado de soporte?')" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginación (si la utilizas) -->
                {{-- {{ $estados_soporte->links() }} --}}
            </div>
        </div>
    </div>
</x-app-layout>
