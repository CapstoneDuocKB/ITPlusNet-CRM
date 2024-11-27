<div x-data="{ open: true }" class="flex flex-col h-screen bg-white fixed transition-all duration-500 ease-in-out"
     :class="open ? 'w-44' : 'w-16'">
    <!-- Parte superior para el ícono (logo) -->
    <div class="flex items-center justify-center bg-white text-black h-16">
        {{-- <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6a1 1 0 001 1h3m-8 8h8a1 1 0 001-1v-7m-5 1a1 1 0 011-1m-4 4h8"></path>
        </svg> --}}
        <img src="{{ asset('img/itplusnet.png') }}" alt="ITPlusNet Logo" class="imgae-fluid p-2 ml-4">
    </div>

    <!-- Enlaces de navegación -->
    <nav class="mt-5 flex flex-col space-y-1 w-full">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center w-full px-4 py-3 rounded-md hover:bg-gray-100
                  {{ request()->routeIs('dashboard') ? 'bg-gray-200 text-black font-bold' : '' }}">
            <svg class="w-6 h-6 flex-shrink-0 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6a1 1 0 001 1h3m-8 8h8a1 1 0 001-1v-7m-5 1a1 1 0 011-1m-4 4h8"></path>
            </svg>
            <span class="ml-4 overflow-hidden whitespace-nowrap transition-opacity duration-300"
                  :class="open ? 'opacity-100' : 'opacity-0'"
                  x-cloak>Dashboard</span>
        </a>

        {{-- <a href="{{ route('dashboard') }}" 
           class="flex items-center w-full px-4 py-3 rounded-md hover:bg-gray-100
                  {{ request()->routeIs('usuarios.index') ? 'bg-gray-200 text-black font-bold' : '' }}">
            <svg class="w-6 h-6 flex-shrink-0 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V10H2v10h5"></path>
            </svg>
            <span class="ml-4 overflow-hidden whitespace-nowrap transition-opacity duration-300"
                  :class="open ? 'opacity-100' : 'opacity-0'"
                  x-cloak>Usuarios</span>
        </a> --}}

        <a href="{{ route('soportes.index') }}" 
           class="flex items-center w-full px-4 py-3 rounded-md hover:bg-gray-100
                  {{ request()->routeIs('soportes.index') ? 'bg-gray-200 text-black font-bold' : '' }}">
            <svg class="w-6 h-6 flex-shrink-0 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v8m0 0h3m-3 0H9m3 0V4m-7 7h14"></path>
            </svg>
            <span class="ml-4 overflow-hidden whitespace-nowrap transition-opacity duration-300"
                  :class="open ? 'opacity-100' : 'opacity-0'"
                  x-cloak>Soportes</span>
        </a>
        @if(Auth::check() && Auth::user()->hasRole('SoporteTecnico'))
            <!-- Grupo 1: Gestión de Almacenes -->
            <div class="relative group" style="position: relative;" x-show="open" x-transition>
                <button>
                    <svg class="w-6 h-6 flex-shrink-0 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">Gestión de Almacenes</span>
                </button>
                <div class="submenu">
                    <a href="{{ route('bodegas.index') }}">Bodegas</a>
                    <a href="{{ route('cajas.index') }}">Cajas</a>
                    <a href="{{ route('sucursales.index') }}">Sucursales</a>
                    <a href="{{ route('empresas.index') }}">Empresas</a>
                </div>
            </div>

            <!-- Grupo 2: Gestión de Ubicaciones -->
            <div class="relative group" style="position: relative;" x-show="open" x-transition>
                <button>
                    <svg class="w-6 h-6 flex-shrink-0 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">Gestión de Ubicaciones</span>
                </button>
                <div class="submenu">
                    <a href="{{ route('comunas.index') }}">Comunas</a>
                    <a href="{{ route('direcciones.index') }}">Direcciones</a>
                    <a href="{{ route('regiones.index') }}">Regiones</a>
                </div>
            </div>

            <!-- Grupo 3: Gestión de Soportes -->
            <div class="relative group" style="position: relative;" x-show="open" x-transition>
                <button>
                    <svg class="w-6 h-6 flex-shrink-0 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">Gestión de Soportes</span>
                </button>
                <div class="submenu">
                    <a href="{{ route('estados_soporte.index') }}">Estados de Soporte</a>
                    <a href="{{ route('tipos_soporte.index') }}">Tipos de Soporte</a>
                    <a href="{{ route('dificultades_soporte.index') }}">Dificultades de Soporte</a>
                </div>
            </div>

        @endif


        <!-- Más enlaces -->
    </nav>

    <!-- Botón para abrir/cerrar en la parte inferior -->
    <div class="relative mt-auto">
        <button @click="open = !open; $dispatch('sidebar-toggle', open)" 
                class="p-4 border bg-white hover:bg-gray-300 rounded-md focus:outline-none shadow-lg transition-all duration-500 ease-in-out"
                :class="open ? 'w-full' : 'w-16'">
            <svg :class="open ? 'rotate-0' : 'rotate-180'" 
                 class="w-6 h-6 transform transition-transform duration-500 ease-in-out mx-auto" 
                 fill="none" stroke="currentColor" 
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
    </div>
</div>


<style>
    /* Estilo base para los submenús */
    .submenu {
        position: absolute;
        left: 100%; /* Posiciona el submenú a la derecha del contenedor principal */
        top: 0;
        margin-left: 10px; /* Separación entre el botón principal y el submenú */
        background-color: white;
        border: 1px solid black;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        width: 250px; /* Ajusta el ancho del submenú */
    }

    /* Mostrar submenú cuando el menú está expandido */
    .group:hover .submenu {
        opacity: 1;
        visibility: visible;
    }

    /* Ocultar textos y submenús cuando el menú está colapsado */
    .collapsed .submenu,
    .collapsed .group span {
        display: none;
    }

    /* Estilo del botón principal */
    .group button {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px;
        border: none;
        background: transparent;
        cursor: pointer;
        border-radius: 5px;
    }

    .group button:hover {
        background-color: #f3f3f3; /* Cambia el color de fondo al pasar el mouse */
    }

    /* Estilo de los enlaces del submenú */
    .submenu a {
        display: block;
        padding: 8px;
        border-radius: 4px;
        text-decoration: none;
        color: black;
    }

    .submenu a:hover {
        background-color: #e5e5e5; /* Cambia el color de fondo al pasar el mouse */
    }
</style>

