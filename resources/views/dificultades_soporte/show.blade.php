<!-- resources/views/dificultades_soporte/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Dificultad de Soporte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <strong>ID:</strong> {{ $dificultad_soporte->id }}
                </div>
                <div class="mb-4">
                    <strong>Nombre:</strong> {{ $dificultad_soporte->nombre }}
                </div>
                <div class="mb-4">
                    <strong>Descripción:</strong> {{ $dificultad_soporte->descripcion }}
                </div>
                <div class="mb-4">
                    <strong>UF:</strong> {{ $dificultad_soporte->uf }}
                </div>
                <!-- Botón de regreso -->
                <a href="{{ route('dificultades_soporte.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                    Atrás
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
