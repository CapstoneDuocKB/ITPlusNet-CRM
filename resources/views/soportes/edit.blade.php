<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atender Soporte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('soportes.update', $soporte->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="container mx-auto p-5">
                        
                        <!-- Sección 1: Datos del Cliente y Ubicación -->
                        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                          <h3 class="font-semibold text-lg mb-6 text-center">Datos y Ubicación del Cliente</h3>
                          
                          <!-- Contenedor Flex con justify-center -->
                          <div class="flex flex-wrap justify-center -mx-4">
                            <!-- Sucursal -->
                            <div class="w-full md:w-1/3 mb-6 px-4">
                              <label class="block text-gray-700 text-sm font-bold mb-2 text-center">Sucursal</label>
                              <p class="text-gray-900 text-center">{{ $soporte->sucursal->nombre ?? 'No asignado' }}</p>
                            </div>
                            <!-- Bodega -->
                            <div class="w-full md:w-1/3 mb-6 px-4">
                              <label class="block text-gray-700 text-sm font-bold mb-2 text-center">Bodega</label>
                              <p class="text-gray-900 text-center">{{ $soporte->bodega->nombre ?? 'No asignado' }}</p>
                            </div>
                            <!-- Caja -->
                            <div class="w-full md:w-1/3 mb-6 px-4">
                              <label class="block text-gray-700 text-sm font-bold mb-2 text-center">Caja</label>
                              <p class="text-gray-900 text-center">{{ $soporte->caja->nombre ?? 'No asignado' }}</p>
                            </div>
                          </div>
                    
                          <!-- Segundo contenedor Flex con justify-center -->
                          <div class="flex flex-wrap justify-center -mx-4">

                            {{-- Rut --}}
                            <div class="w-full md:w-1/3 mb-6 px-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2 text-center">Rut</label>
                                <p class="text-gray-900 text-center">{{ $creador_soporte->rut  }}</p>
                            </div>
                            <!-- Celular -->
                            <div class="w-full md:w-1/3 mb-6 px-4">
                              <label class="block text-gray-700 text-sm font-bold mb-2 text-center">Celular</label>
                              <p class="text-gray-900 text-center">{{ $soporte->celular }}</p>
                            </div>
                            <!-- Email -->
                            <div class="w-full md:w-1/3 mb-6 px-4">
                              <label class="block text-gray-700 text-sm font-bold mb-2 text-center">Email</label>
                              <p class="text-gray-900 text-center">{{ $soporte->email }}</p>
                            </div>

                          </div>
                          
                        </div>
                    </div>

                    <!-- Sección 2: Datos del Soporte -->
                <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                    <h3 class="font-semibold text-lg mb-6 text-center">Datos del Soporte</h3>
                    <div class="flex flex-wrap justify-center -mx-4">

                        <div class="w-full md:w-1/2 mb-6 px-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-center">Creado Por</label>
                            <p class="text-gray-900 text-center">{{ $creador_soporte->name  }}</p>
                        </div>

                        <div class="w-full md:w-1/2 mb-6 px-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-center">Fecha Creación</label>
                            <p class="text-gray-900 text-center">{{ $soporte->created_at  }}</p>
                        </div>

                        <!-- Tipo de Soporte -->
                        <div class="w-full md:w-1/2 mb-6 px-4">
                            <label for="tipo_soporte_id" class="block text-gray-700 text-sm font-bold mb-2 text-center">Tipo de Soporte</label>
                            <select name="tipo_soporte_id" id="tipo_soporte_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm text-center">
                                <option value="">Seleccionar tipo del soporte</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ old('tipo_soporte_id', $soporte->tipo_soporte_id) == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dificultad de Soporte -->
                        <div class="w-full md:w-1/2 mb-6 px-4">
                            <label for="dificultad_soporte_id" class="block text-gray-700 text-sm font-bold mb-2 text-center">Dificultad de Soporte</label>
                            <select name="dificultad_soporte_id" id="dificultad_soporte_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm text-center">
                                <option value="">Seleccionar dificultad del soporte</option>
                                @foreach($dificultades as $dificultad)
                                    <option value="{{ $dificultad->id }}" {{ old('dificultad_soporte_id', $soporte->dificultad_soporte_id) == $dificultad->id ? 'selected' : '' }}>{{ $dificultad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                     <!-- Descripción -->
                     <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2 text-center">Descripción Soporte</label>
                        <textarea 
                          id="descripcion" 
                          name="descripcion" 
                          rows="4" 
                          maxlength="4000" 
                          class="block mx-auto text-center w-full bg-white border border-gray-300 rounded-md shadow-sm" 
                          disabled
                        >{{ old('descripcion', $soporte->descripcion) }}</textarea>
                      </div>

                    {{-- Chat Soporte --}}
                    <div class="container mx-auto p-5 pt-2">

                        <h1 class="font-semibold text-lg mb-6 text-center">Chat del Soporte</h1>
                        <div class="border rounded">
                          <div x-data="{ open: false }" class="w-full">
                            <button  type="button"
                              @click="open = !open" 
                              class="w-full text-center px-4 py-2 bg-lime-500 text-white hover:bg-lime-600 focus:outline-none flex justify-center items-center"
                              :aria-expanded="open" 
                              aria-controls="chat-support-content"
                            >
                                <span class="font-medium">Ver Chat</span>
                                <span class="ml-2 transition-transform duration-300" :class="{ 'rotate-180': open }">
                                        <!-- Icono de flecha -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </button>
                            <div 
                              x-show="open" 
                              x-transition 
                              id="chat-support-content" 
                              role="region" 
                              aria-labelledby="chat-support-button" 
                              class="px-4 py-2 bg-gray-100 text-center"
                            >
                            <!-- Estilos personalizados para las burbujas de mensajes -->
                            <style>
                                /* Contenedor general de los mensajes */
                                #chat-messages {
                                    max-height: 400px; /* Ajusta según tus necesidades */
                                    overflow-y: auto;
                                    padding: 10px;
                                    background-color: #f8f9fa;
                                    border-radius: 5px;
                                }

                                /* Estilo para mensajes del bot */
                                .chat-message.bot {
                                    display: flex;
                                    align-items: flex-start;
                                    margin-bottom: 10px;
                                }

                                .chat-message.bot .message-content {
                                    background-color: #e2e3e5; /* Gris claro para el bot */
                                    color: #000;
                                    padding: 10px 15px;
                                    border-radius: 15px;
                                    max-width: 70%; /* Limita el ancho máximo para que sean más cortos */
                                    word-wrap: break-word;
                                }

                                /* Estilo para mensajes del usuario */
                                .chat-message.user {
                                    display: flex;
                                    align-items: flex-end;
                                    justify-content: flex-end;
                                    margin-bottom: 10px;
                                }

                                .chat-message.user .message-content {
                                    background-color: #84cc16; /* lime-500 de Tailwind */
                                    color: #fff;
                                    padding: 10px 15px;
                                    border-radius: 15px;
                                    max-width: 70%; /* Limita el ancho máximo para que sean más cortos */
                                    word-wrap: break-word;
                                }

                                /* Opcional: Ajustar la fuente y el tamaño del texto */
                                .message-content {
                                    font-size: 14px;
                                    line-height: 1.4;
                                }
                            </style>

                                 <!-- Contenedor de mensajes -->
                                <div id="chat-messages">
                                    @foreach ($messages as $message)
                                        @if ($message->role == 'assistant')
                                            <div class="chat-message bot">
                                                <div class="message-content text-start">
                                                    {{ $message->content }}
                                                </div>
                                            </div>
                                        @elseif ($message->role == 'user')
                                            <div class="chat-message user">
                                                <div class="message-content text-start">
                                                    {{ $message->content }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <style>
                            .accordion-button-custom {
                                text-align: center;
                                flex-direction: column;
                                align-items: center;
                            }
                            
                            .accordion-button-custom::after {
                                margin-left: 0;
                                margin-top: 0.5rem;
                            }
                            </style>

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        Accordion Item #1
                                    </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample" style="">
                                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>

            <!-- Sección 3: Detalles de Costos -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <!-- Urgente -->
                <h3 class="font-semibold text-lg mb-6 text-center">Detalles de Costos</h3>
                <div class="flex flex-wrap justify-center -mx-4">
                    <!-- Horas Hombre -->
                    <div class="w-full md:w-1/3 mb-6 px-4">
                        <label for="horas_hombre" class="block text-gray-700 text-sm font-bold mb-2 text-center">Horas Hombre</label>
                        <input 
                            type="number" 
                            required 
                            step="0.01" 
                            id="horas_hombre" 
                            name="horas_hombre" 
                            value="{{ old('horas_hombre', $soporte->horas_hombre) }}" 
                            class="block mx-auto text-center w-full bg-white border border-gray-300 rounded-md shadow-sm"/>
                    </div>

                    <!-- UF -->
                    <div class="w-full md:w-1/3 mb-6 px-4">
                        <label for="uf" class="block text-gray-700 text-sm font-bold mb-2 text-center">UF</label>
                        <input 
                            type="number" 
                            required 
                            step="0.01" 
                            id="uf" 
                            name="uf" 
                            value="{{ old('uf', $soporte->uf) }}" 
                            class="block mx-auto text-center w-full bg-white border border-gray-300 rounded-md shadow-sm"/>
                    </div>

                    <!-- Estados de Cobranza -->
                    <div class="w-full md:w-1/3 mb-6 px-4">
                        <label for="estado_cobranza_id" class="block text-gray-700 text-sm font-bold mb-2 text-center">Estado de Cobranza</label>
                        <select name="estado_cobranza_id" id="estado_cobranza_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm text-center">
                            <option value="">Seleccionar tipo del soporte</option>
                            @foreach($estadosCobranza as $estadoCobranza)
                                <option value="{{ $estadoCobranza->id }}" {{ old('estado_cobranza_id', $soporte->estado_cobranza_id) == $estadoCobranza->id ? 'selected' : '' }}>{{ $estadoCobranza->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <strong class="mb-6 d-flex justify-content-center {{ old('urgente', $soporte->urgente) ? 'text-danger' : 'text-primary' }}">{{ old('urgente', $soporte->urgente) ? 'Es Urgente' : 'No es Urgente' }}</strong>

                </div>
            </div>


            <h3 class="font-semibold text-lg mb-4 text-center">Solución Soporte</h3>

             <!-- Estilos personalizados para la línea temporal -->
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

            <div class="wrapper container-fluid">
            <!-- Otros contenidos de la vista edit -->

            <!-- Línea Temporal -->
                <div class="mt-2">
                    <h3 class="text-center mb-4">Línea Temporal de Soporte</h3>
                    <ul class="timeline">
                        @foreach ($estadosSoporte as $estadoSoporte)
                            @php
                                // Verificar si el estado está alcanzado
                                $isAchieved = $historialEstados->contains('estado_soporte_id', $estadoSoporte->id);
                                // Obtener el historial correspondiente a este estado, si existe
                                $historial = $historialEstados->firstWhere('estado_soporte_id', $estadoSoporte->id);
                            @endphp
                            <li class="timeline-item">
                                <div class="timeline-point {{ $isAchieved ? 'green' : 'gray' }}"></div>
                                <div class="timeline-content">
                                    <h5>{{ $estadoSoporte->nombre }}</h5>
                                    @if($isAchieved && $historial)
                                    @if($historial->comentario)
                                        <p><strong>Comentario:</strong> {{ $historial->comentario }}</p>
                                    @endif
                                    <p><strong>Por:</strong> {{ $historial->usuario->name ?? 'Desconocido' }}</p>
                                    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($historial->created_at)->format('d-m-Y H:i:s') }}</p>
                                    @else
                                        <p class="text-muted">Aún no alcanzado</p>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="flex flex-wrap justify-center -mx-4">
                <!-- Estado del Soporte -->
                <div class="w-full md:w-1/2 mb-2 px-4">
                    <label for="estado_soporte_id" class="block text-gray-700 text-sm font-bold mb-2 text-center">Estado del Soporte</label>
                    <select name="estado_soporte_id" id="estado_soporte_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm text-center">
                        @foreach($estadoSoporteSelect as $estadoSoporte)
                            @if($estadoSoporte->nombre == 'Abierto')
                                <option value="{{ $estadoSoporte->id }}" {{ old('estado_soporte_id', $soporte->estado_soporte_id) == $estadoSoporte->id ? 'selected disabled' : '' }}>{{ $estadoSoporte->nombre }}</option>
                            @else
                                <option value="{{ $estadoSoporte->id }}" {{ old('estado_soporte_id', $soporte->estado_soporte_id) == $estadoSoporte->id ? 'selected' : '' }}>{{ $estadoSoporte->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Fecha estimada de entrega -->
                <div class="w-full md:w-1/2 mb-6 px-4">
                    <label for="fecha_estimada_entrega" class="block text-gray-700 text-sm font-bold mb-2 text-center">Fecha Estimada de Entrega</label>
                    <input 
                        type="date" 
                        required 
                        step="0.01" 
                        id="fecha_estimada_entrega" 
                        name="fecha_estimada_entrega" 
                        value="{{ old('fecha_estimada_entrega', $soporte->fecha_estimada_entrega) }}" 
                        class="block mx-auto text-center w-full bg-white border border-gray-300 rounded-md shadow-sm"
                    >
                </div>

            </div>

            <!-- Solución -->
            <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                <div class="mb-4">
                    <label for="solucion" class="block text-gray-700 text-sm font-bold mb-2 text-center">Solución</label>
                    <textarea id="solucion" required name="solucion" rows="4" maxlength="4000" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">{{ old('solucion', $soporte->solucion) }}</textarea>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-between">
                <a href="{{ route('soportes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Atrás
                </a>
                <x-button id="crear-soporte-btn" class="mb-4">
                    {{ __('Actualizar Soporte') }}
                </x-button>
            </div>
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
