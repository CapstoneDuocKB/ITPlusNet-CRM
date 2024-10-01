<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Listado de Comunas') }}
    </h2>
</x-slot>

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <a href="{{ route('comunas.create') }}"
        class="mb-4 inline-flex items-center px-4 py-2 bg-indigo-600
        border border-transparent rounded-md font-semibold text-white
        hover:bg-indigo-700">
        Crear Nueva Comuna
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
                    <th class="px-6 py-3 border-b">Región</th>
                    <th class="px-6 py-3 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comunas as $comuna)
                <tr>
                    <td class="px-6 py-4 border-b">{{ $comuna->id }}</td>
                    <td class="px-6 py-4 border-b">{{ $comuna->nombre }}</td>
                    <td class="px-6 py-4 border-b">
                        {{ $comuna->region->nombre ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 border-b">
                        <a href="{{ route('comunas.show', $comuna->id) }}"
                            class="text-blue-600 hover:text-blue-900">Ver</a> |
                        <a href="{{ route('comunas.edit', $comuna->id) }}"
                            class="text-indigo-600 hover:text-indigo-900">
                            Editar
                        </a> |
                        <form action="{{ route('comunas.destroy', $comuna->id) }}"
                            method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('¿Eliminar esta comuna?')"
                                class="text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
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
