<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Metadatos -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fuentes -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/js/app.js', 'resources/css/app.css'])

        @stack('styles')


        <!-- Styles -->
        @livewireStyles

        <!-- Alpine.js -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> -->

        <!-- Estilos adicionales -->
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
    </head>
    <body class="font-sans antialiased" x-data="{ sidebarOpen: true }" @sidebar-toggle.window="sidebarOpen = $event.detail">
        <x-banner />

        <div class="flex min-h-screen bg-gray-100">
            <!-- Barra lateral -->
            <x-sidebar />

            <!-- Contenido principal -->
            <div class="flex-1 flex flex-col transition-all duration-500 ease-in-out"
                 :class="sidebarOpen ? 'ml-44' : 'ml-16'">
                <!-- Menú de navegación -->
                @livewire('navigation-menu')

                <!-- Encabezado de la página -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Contenido de la página -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')

    </body>
</html>
