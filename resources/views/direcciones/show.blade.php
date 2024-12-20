<!-- resources/views/direcciones/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Dirección') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <strong>ID:</strong> {{ $direccion->id }}
                </div>
                <div class="mb-4">
                    <strong>Calle:</strong> {{ $direccion->calle }}
                </div>
                <div class="mb-4">
                    <strong>Número:</strong> {{ $direccion->numero }}
                </div>
                <div class="mb-4">
                    <strong>Comuna:</strong> {{ $direccion->comuna->nombre ?? 'N/A' }}
                </div>
                <!-- Botón de regreso -->
                <a href="{{ route('direcciones.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                    Atrás
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
