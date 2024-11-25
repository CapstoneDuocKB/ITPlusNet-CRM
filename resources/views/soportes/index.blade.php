<!-- resources/views/soportes/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Listado de Soportes</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::check() && Auth::user()->hasRole('Cliente'))
                <a href="{{ route('soportes.create') }}" class="mb-4 inline-flex items-center px-4 py-2 bg-lime-500 border border-transparent rounded-md font-semibold text-white hover:bg-lime-600">
                    Crear Nuevo Soporte
                </a>
            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if($soportes->isEmpty())
                    <div class="text-center py-20">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m2 0a2 2 0 110 4H7a2 2 0 110-4h2m2 0V7a2 2 0 114 0v6m2 0a2 2 0 110 4H5a2 2 0 110-4h14z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aun no tienes soportes registrados.</h3>
                        @if(Auth::check() && Auth::user()->hasRole('Cliente'))
                            <p class="mt-1 text-sm text-gray-500">Haz clic en el botón de arriba para crear tu primer soporte.</p>
                        @endif
                    </div>
                @else
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número Soporte</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Urgente</th>
                                <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($soportes as $soporte)
                            <tr>
                                <td class="px-6 py-4 border-b">{{ $soporte->numero_soporte }}</td>
                                <td class="px-6 py-4 border-b">{{ Str::limit($soporte->descripcion, 50) }}</td>
                                <td class="px-6 py-4 border-b">
                                    @php
                                        // Obtener el nombre del estado o asignar 'Sin Definir' por defecto
                                        $estadoNombre = $soporte->estadoSoporte->nombre ?? 'Sin Definir';
                                
                                        // Inicializar variables para las clases
                                        $bgColor = 'bg-gray-100';
                                        $textColor = 'text-gray-800';
                                
                                        // Determinar las clases según el estado
                                        switch ($estadoNombre) {
                                            case 'Creado':
                                                $bgColor = 'bg-yellow-100';
                                                $textColor = 'text-yellow-800';
                                                break;
                                            case 'Abierto':
                                                $bgColor = 'bg-blue-100';
                                                $textColor = 'text-blue-800';
                                                break;
                                            case 'En Desarrollo':
                                                $bgColor = 'bg-green-100';
                                                $textColor = 'text-green-800';
                                                break;
                                            case 'Cerrado':
                                                $bgColor = 'bg-gray-100';
                                                $textColor = 'text-gray-800';
                                                break;
                                            default:
                                                $bgColor = 'bg-gray-100';
                                                $textColor = 'text-gray-800';
                                        }
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bgColor }} {{ $textColor }}">
                                        {{ $estadoNombre }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 border-b">{{ $soporte->tipoSoporte->nombre ?? 'Sin Definir' }}</td>
                                <td class="px-6 py-4 border-b">{{ $soporte->urgente ? 'Sí' : 'No' }}</td>
                                <td class="px-6 py-4 border-b">
                                    <a href="{{ route('soportes.show', $soporte->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                                    @if(Auth::check() && Auth::user()->hasRole('Cliente'))
                                        <a href="{{ route('soportes.edit', $soporte->id) }}" class="text-indigo-600 hover:text-indigo-900">Atender soporte</a> |
                                    @endif
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
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
