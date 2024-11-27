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
                <!-- Identificación del Soporte -->
                <div class="mb-8 p-6 shadow-lg rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Identificación del Soporte</h3>
                    <div class="grid grid-cols-4 gap-4 text-center">
                        <div><strong>Número Soporte:</strong> {{ $soporte->numero_soporte }}</div>
                        <div><strong>Tipo:</strong> {{ $soporte->tipoSoporte->nombre ?? 'N/A' }}</div>
                        <div><strong>Estado:</strong> {{ $soporte->estadoSoporte->nombre ?? 'N/A' }}</div>
                        <div><strong>Dificultad de Soporte:</strong> {{ $soporte->dificultadSoporte->nombre ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Ubicación del Soporte -->
                <div class="grid grid-cols-2 gap-4 mb-6 text-center">
                    <div><strong>Bodega:</strong> {{ $soporte->bodega->nombre ?? 'N/A' }}</div>
                    <div><strong>Caja:</strong> {{ $soporte->caja->nombre ?? 'N/A' }}</div>
                </div>
                <!-- Descripción -->
                <div class="mb-8 p-6 shadow-lg rounded-lg border border-gray-200 bg-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Descripción</h3>
                    <div class="text-center overflow-hidden text-ellipsis max-h-48">
                        {{ $soporte->descripcion }}
                    </div>
                </div>


                <!-- Datos de Contacto -->
                <div class="mb-8 p-6 shadow-lg rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Datos de Contacto</h3>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div><strong>Celular:</strong> {{ $soporte->celular }}</div>
                        <div><strong>Email:</strong> {{ $soporte->email }}</div>
                    </div>
                </div>


                <div class="gap-4 mb-6 text-center">
                    <div><strong>Urgente:</strong> {{ $soporte->urgente ? 'Sí' : 'No' }}</div>
                </div>  
                <!-- Información de Urgencia -->
                <div class="grid grid-cols-2 gap-4 mb-6 text-center">
                    <div><strong>Horas Hombre:</strong> {{ $soporte->horas_hombre }}</div>
                    <div><strong>UF:</strong> {{ $soporte->uf }}</div>
                </div>

                <!-- Timestamps -->
                <div class="mb-8 p-6 shadow-lg rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Timestamps</h3>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div><strong>Creado en:</strong> {{ $soporte->created_at }}</div>
                        <div><strong>Actualizado en:</strong> {{ $soporte->updated_at }}</div>
                    </div>
                </div>

                <!-- Solución -->
                <div class="mb-8 p-6 shadow-lg rounded-lg border border-gray-200 bg-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Solución</h3>
                    <div class="text-center overflow-hidden text-ellipsis max-h-48">
                        {{ $soporte->solucion }}
                    </div>
                </div>

                <!-- Botón de regreso -->
                <a href="{{ route('soportes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Atrás
                </a>
            </div>
        </div>
    </div>
</x-app-layout>