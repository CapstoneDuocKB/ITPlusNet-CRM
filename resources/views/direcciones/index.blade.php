<!-- resources/views/direcciones/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Direcciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('direcciones.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                Crear Nueva Dirección
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
                            <th class="px-6 py-3 border-b">Calle</th>
                            <th class="px-6 py-3 border-b">Número</th>
                            <th class="px-6 py-3 border-b">Comuna</th>
                            <th class="px-6 py-3 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($direcciones as $direccion)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $direccion->id }}</td>
                            <td class="px-6 py-4 border-b">{{ $direccion->calle }}</td>
                            <td class="px-6 py-4 border-b">{{ $direccion->numero }}</td>
                            <td class="px-6 py-4 border-b">{{ $direccion->comuna->nombre ?? 'N/A' }}</td>
                            <td class="px-6 py-4 border-b">
                                <a href="{{ route('direcciones.show', $direccion->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                                <a href="{{ route('direcciones.edit', $direccion->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a> |
                                <form action="{{ route('direcciones.destroy', $direccion->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta dirección?')" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginación (si la utilizas) -->
                {{-- {{ $direcciones->links() }} --}}
            </div>
        </div>
    </div>
</x-app-layout>
