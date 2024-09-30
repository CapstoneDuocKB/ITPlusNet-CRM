<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Soportes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Tabla de soportes -->
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Número de Soporte</th>
                                <th>Descripción</th>
                                <th>Tipo de Soporte</th>
                                <th>Estado</th>
                                <th>Urgente</th>
                                <th>Fecha de Creación</th>
                                <th>Última Actualización</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($soportes as $soporte)
                            <tr>
                                <td>{{ $soporte->numero_soporte }}</td>
                                <td>{{ Str::limit($soporte->descripcion, 100) }}</td>
                                <td>{{ $soporte->tipoSoporte->nombre }}</td>
                                <td>{{ $soporte->estadoSoporte->nombre }}</td>
                                <td>
                                    @if($soporte->urgente)
                                        <span class="badge bg-danger">Sí</span>
                                    @else
                                        <span class="badge bg-success">No</span>
                                    @endif
                                </td>
                                <td>{{ $soporte->created_at->format('d-m-Y') }}</td>
                                <td>{{ $soporte->updated_at->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $soportes->links() }}
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('soportes.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Crear Nuevo Soporte
                    </a>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Atrás
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
