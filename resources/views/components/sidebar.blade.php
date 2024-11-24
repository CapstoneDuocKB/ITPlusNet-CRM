<div x-data="{ open: true }" class="flex flex-col h-screen bg-white fixed transition-all duration-500 ease-in-out"
     :class="open ? 'w-44' : 'w-16'">
    <!-- Parte superior para el ícono (logo) -->
    <div class="flex items-center justify-center bg-white text-black h-16">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6a1 1 0 001 1h3m-8 8h8a1 1 0 001-1v-7m-5 1a1 1 0 011-1m-4 4h8"></path>
        </svg>
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

        <a href="{{ route('dashboard') }}" 
           class="flex items-center w-full px-4 py-3 rounded-md hover:bg-gray-100
                  {{ request()->routeIs('usuarios.index') ? 'bg-gray-200 text-black font-bold' : '' }}">
            <svg class="w-6 h-6 flex-shrink-0 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V10H2v10h5"></path>
            </svg>
            <span class="ml-4 overflow-hidden whitespace-nowrap transition-opacity duration-300"
                  :class="open ? 'opacity-100' : 'opacity-0'"
                  x-cloak>Usuarios</span>
        </a>

        <a href="{{ route('soportes.index') }}" 
           class="flex items-center w-full px-4 py-3 rounded-md hover:bg-gray-100
                  {{ request()->routeIs('profile.show') ? 'bg-gray-200 text-black font-bold' : '' }}">
            <svg class="w-6 h-6 flex-shrink-0 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v8m0 0h3m-3 0H9m3 0V4m-7 7h14"></path>
            </svg>
            <span class="ml-4 overflow-hidden whitespace-nowrap transition-opacity duration-300"
                  :class="open ? 'opacity-100' : 'opacity-0'"
                  x-cloak>Soportes</span>
        </a>

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
