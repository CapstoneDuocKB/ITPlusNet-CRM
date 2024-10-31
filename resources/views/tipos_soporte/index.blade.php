<!-- resources/views/tipos_soporte/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Tipos de Soporte</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('tipos_soporte.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                Crear Nuevo Tipo de Soporte
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
                        @foreach($tipos_soporte as $tipo)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $tipo->id }}</td>
                            <td class="px-6 py-4 border-b">{{ $tipo->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $tipo->descripcion }}</td>
                            <td class="px-6 py-4 border-b">
                                <a href="{{ route('tipos_soporte.show', $tipo->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                                <a href="{{ route('tipos_soporte.edit', $tipo->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a> |
                                <form action="{{ route('tipos_soporte.destroy', $tipo->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este tipo de soporte?')" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginación (si la utilizas) -->
                {{-- {{ $tipos_soporte->links() }} --}}
            </div>
        </div>
    </div>
</x-app-layout>
