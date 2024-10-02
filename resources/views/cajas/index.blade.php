<!-- resources/views/cajas/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Cajas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('cajas.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                Crear Nueva Caja
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
                            <th class="px-6 py-3 border-b">Sucursal</th>
                            <th class="px-6 py-3 border-b">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cajas as $caja)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $caja->id }}</td>
                            <td class="px-6 py-4 border-b">{{ $caja->nombre }}</td>
                            <td class="px-6 py-4 border-b">{{ $caja->activa ? 'Sí' : 'No' }}</td>
                            <td class="px-6 py-4 border-b">{{ $caja->sucursal->nombre ?? 'Sin Sucursal' }}</td>
                            <td class="px-6 py-4 border-b">
                                <a href="{{ route('cajas.show', $caja->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                                <a href="{{ route('cajas.edit', $caja->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a> |
                                <form action="{{ route('cajas.destroy', $caja->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar esta caja?')" class="text-red-600 hover:text-red-900">Eliminar</button>
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
