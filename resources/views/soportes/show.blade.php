<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Soporte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Tarjeta Principal -->
            <div class="bg-white shadow-xl rounded-lg p-6">
                <!-- Timestamps -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700">Historial</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div><strong>Creado por:</strong> {{ $creador_soporte->name ?? 'Desconocido' }}</div>
                        <div><strong>Fecha Creación:</strong> {{ $soporte->created_at->format('d/m/Y H:i') }}</div>
                        <div><strong>Actualizado en:</strong> {{ $soporte->updated_at->format('d/m/Y H:i') }}</div>
                        <div><strong>Estado Actual:</strong> {{ $soporte->estadoSoporte->nombre ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Línea Temporal -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 text-center mb-4">Línea Temporal de Soporte</h3>
                    <ul class="timeline">
                        @foreach ($estadosSoporte as $estadoSoporte)
                            @php
                                // Verificar si el estado está alcanzado
                                $isAchieved = $historialEstados->contains('estado_soporte_id', $estadoSoporte->id);
                                // Obtener el historial correspondiente a este estado, si existe
                                $historial = $historialEstados->firstWhere('estado_soporte_id', $estadoSoporte->id);
                            @endphp
                            <li class="timeline-item">
                                <div class="timeline-point {{ $isAchieved ? 'bg-green-500 border-green-500' : 'bg-gray-500 border-gray-500' }}"></div>
                                <div class="timeline-content">
                                    <h5 class="font-semibold">{{ $estadoSoporte->nombre }}</h5>
                                    @if($isAchieved && $historial)
                                        <p><strong>Por:</strong> {{ $historial->usuario->name ?? 'Desconocido' }}</p>
                                        <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($historial->created_at)->format('d-m-Y H:i:s') }}</p>
                                        @if($historial->comentario)
                                            <p><strong>Comentario:</strong> {{ $historial->comentario }}</p>
                                        @endif
                                    @else
                                        <p class="text-gray-500">Aún no alcanzado</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Identificación y Ubicación del Soporte -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Identificación del Soporte -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Identificación del Soporte</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <div><strong>Número Soporte:</strong> {{ $soporte->numero_soporte }}</div>
                            <div><strong>Tipo:</strong> {{ $soporte->tipoSoporte->nombre ?? 'N/A' }}</div>
                            <div><strong>Estado:</strong> {{ $soporte->estadoSoporte->nombre ?? 'N/A' }}</div>
                            <div><strong>Dificultad:</strong> {{ $soporte->dificultadSoporte->nombre ?? 'N/A' }}</div>
                        </div>
                    </div>
                    
                    <!-- Ubicación del Soporte -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Ubicación</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <div><strong>Bodega:</strong> {{ $soporte->bodega->nombre ?? 'N/A' }}</div>
                            <div><strong>Caja:</strong> {{ $soporte->caja->nombre ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Descripción y Solución -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    
                    <!-- Descripción -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Descripción</h3>
                        <p class="text-gray-600">{{ $soporte->descripcion }}</p>
                    </div>
                    
                    <!-- Solución -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Solución</h3>
                        <p class="text-gray-600">{{ $soporte->solucion ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Datos de Contacto y Urgencia -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    
                    <!-- Datos de Contacto -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Datos de Contacto</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <div><strong>Celular:</strong> {{ $soporte->celular }}</div>
                            <div><strong>Email:</strong> {{ $soporte->email }}</div>
                        </div>
                    </div>
                    
                    <!-- Información de Urgencia -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700">Urgencia</h3>
                        <div>
                            <strong>Urgente:</strong> 
                            <span class="{{ $soporte->urgente ? 'text-red-600 font-semibold' : 'text-gray-800' }}">
                                {{ $soporte->urgente ? 'Sí' : 'No' }}
                            </span>
                        </div>
                        <div><strong>Horas Hombre:</strong> {{ $soporte->horas_hombre }}</div>
                        <div><strong>UF:</strong> {{ $soporte->uf }}</div>
                    </div>
                </div>

                

                <!-- Botón de Regreso -->
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('soportes.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">
                        Atrás
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
                body {
                    margin: 0;
                    font-family: Futura, Arial, Helvetica, sans-serif;
                    color: #072541;
                    background-color: #f8f9fa;
                }

                .timeline {
                    position: relative;
                    padding: 20px 0;
                    list-style: none;
                }

                .timeline:before {
                    content: '';
                    position: absolute;
                    left: 50%;
                    top: 0;
                    bottom: 0;
                    width: 2px;
                    background: #C5C5C5;
                    transform: translateX(-50%);
                }

                /* Elementos de la línea temporal */
                .timeline-item {
                    position: relative;
                    margin-bottom: 50px;
                }

                .timeline-item:nth-child(odd) .timeline-content {
                    left: 50%;
                    text-align: left;
                }

                .timeline-item:nth-child(even) .timeline-content {
                    left: 0;
                    text-align: right;
                }

                .timeline-item::after {
                    content: "";
                    display: table;
                    clear: both;
                }

                /* Punto en la línea */
                .timeline-point {
                    position: absolute;
                    top: 0;
                    left: 50%;
                    width: 20px;
                    height: 20px;
                    background: #fff;
                    border: 2px solid #C5C5C5;
                    border-radius: 50%;
                    transform: translate(-50%, 0);
                    z-index: 1;
                }

                /* Color de los puntos */
                .timeline-point.green {
                    background-color: #28a745;
                    border-color: #28a745;
                }

                .timeline-point.gray {
                    background-color: #6c757d;
                    border-color: #6c757d;
                }

                /* Contenido de cada elemento */
                .timeline-content {
                    position: relative;
                    width: 45%;
                    padding: 10px 20px;
                    background: #f0f0f0;
                    border-radius: 6px;
                }

                /* Flechas */
                .timeline-item:nth-child(odd) .timeline-content::before {
                    content: " ";
                    position: absolute;
                    top: 15px;
                    right: -15px;
                    border-width: 8px 0 8px 15px;
                    border-style: solid;
                    border-color: transparent transparent transparent #f0f0f0;
                }

                .timeline-item:nth-child(even) .timeline-content::before {
                    content: " ";
                    position: absolute;
                    top: 15px;
                    left: -15px;
                    border-width: 8px 15px 8px 0;
                    border-style: solid;
                    border-color: transparent #f0f0f0 transparent transparent;
                }

                /* Responsividad */
                @media (max-width: 768px) {
                    .timeline:before {
                        left: 8px;
                    }

                    .timeline-item {
                        margin-bottom: 30px;
                    }

                    .timeline-point {
                        left: 8px;
                    }

                    .timeline-content {
                        width: calc(100% - 30px);
                        left: 30px !important;
                        text-align: left !important;
                    }

                    .timeline-item:nth-child(odd) .timeline-content,
                    .timeline-item:nth-child(even) .timeline-content {
                        left: 30px !important;
                        text-align: left !important;
                    }

                    .timeline-item:nth-child(odd) .timeline-content::before,
                    .timeline-item:nth-child(even) .timeline-content::before {
                        left: -15px;
                        border-width: 8px 15px 8px 0;
                        border-color: transparent #f0f0f0 transparent transparent;
                    }
                }
            </style>
</x-app-layout>
