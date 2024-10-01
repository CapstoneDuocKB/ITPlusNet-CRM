<!-- resources/views/sucursales/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Sucursal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <strong>ID:</strong> {{ $sucursal->id }}
                </div>
                <div class="mb-4">
                    <strong>Nombre:</strong> {{ $sucursal->nombre }}
                </div>
                <div class="mb-4">
                    <strong>Activa:</strong> {{ $sucursal->activa ? 'Sí' : 'No' }}
                </div>
                <div class="mb-4">
                    <strong>Dirección ID:</strong> {{ $sucursal->direccion_id }}
                </div>
                <div class="mb-4">
                    <strong>Sucursal Padre ID:</strong> {{ $sucursal->sucursal_id }}
                </div>
                <div class="mb-4">
                    <strong>Empresa ID:</strong> {{ $sucursal->empresa_id }}
                </div>
                <!-- Botón de regreso -->
                <a href="{{ route('sucursales.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                    Atrás
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
