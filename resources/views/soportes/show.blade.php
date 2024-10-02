<!-- resources/views/soportes/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Soporte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Mostrar detalles del soporte -->
                <div class="mb-4">
                    <strong>Número Soporte:</strong> {{ $soporte->numero_soporte }}
                </div>
                <div class="mb-4">
                    <strong>Descripción:</strong> {{ $soporte->descripcion }}
                </div>
                <div class="mb-4">
                    <strong>Solución:</strong> {{ $soporte->solucion }}
                </div>
                <div class="mb-4">
                    <strong>Estado:</strong> {{ $soporte->estadoSoporte->nombre ?? 'N/A' }}
                </div>
                <div class="mb-4">
                    <strong>Tipo:</strong> {{ $soporte->tipoSoporte->nombre ?? 'N/A' }}
                </div>
                <div class="mb-4">
                    <strong>Urgente:</strong> {{ $soporte->urgente ? 'Sí' : 'No' }}
                </div>
                <div class="mb-4">
                    <strong>Horas Hombre:</strong> {{ $soporte->horas_hombre }}
                </div>
                <div class="mb-4">
                    <strong>UF:</strong> {{ $soporte->uf }}
                </div>
                <div class="mb-4">
                    <strong>Celular:</strong> {{ $soporte->celular }}
                </div>
                <div class="mb-4">
                    <strong>Email:</strong> {{ $soporte->email }}
                </div>
                <div class="mb-4">
                    <strong>Bodega:</strong> {{ $soporte->bodega->nombre ?? 'N/A' }}
                </div>
                <div class="mb-4">
                    <strong>Caja:</strong> {{ $soporte->caja->nombre ?? 'N/A' }}
                </div>
                <div class="mb-4">
                    <strong>Dificultad de Soporte:</strong> {{ $soporte->dificultadSoporte->nombre ?? 'N/A' }}
                </div>
                <div class="mb-4">
                    <strong>Creado en:</strong> {{ $soporte->created_at }}
                </div>
                <div class="mb-4">
                    <strong>Actualizado en:</strong> {{ $soporte->updated_at }}
                </div>
                <!-- Botón de regreso -->
                <a href="{{ route('soportes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Atrás
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
