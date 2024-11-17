<!-- resources/views/soportes/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Soportes</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('soportes.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                Crear Nuevo Soporte
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
                            <th class="px-6 py-3 border-b">Número Soporte</th>
                            <th class="px-6 py-3 border-b">Descripción</th>
                            <th class="px-6 py-3 border-b">Estado</th>
                            <th class="px-6 py-3 border-b">Tipo</th>
                            <th class="px-6 py-3 border-b">Urgente</th>
                            <th class="px-6 py-3 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soportes as $soporte)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $soporte->numero_soporte }}</td>
                            <td class="px-6 py-4 border-b">{{ Str::limit($soporte->descripcion, 50) }}</td>
                            <td class="px-6 py-4 border-b">{{ $soporte->estadoSoporte->nombre ?? 'N/A' }}</td>
                            <td class="px-6 py-4 border-b">{{ $soporte->tipoSoporte->nombre ?? 'N/A' }}</td>
                            <td class="px-6 py-4 border-b">{{ $soporte->urgente ? 'Sí' : 'No' }}</td>
                            <td class="px-6 py-4 border-b">
                                <a href="{{ route('soportes.show', $soporte->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                                <a href="{{ route('soportes.edit', $soporte->id) }}" class="text-indigo-600 hover:text-indigo-900">Atender soporte</a> |
                                <form action="{{ route('soportes.destroy', $soporte->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este soporte?')" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginación -->
                <div class="mt-4">
                    {{ $soportes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
