<!-- resources/views/empresas/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <strong>ID:</strong> {{ $empresa->id }}
                </div>
                <div class="mb-4">
                    <strong>RUT:</strong> {{ $empresa->rut }}
                </div>
                <div class="mb-4">
                    <strong>Nombre:</strong> {{ $empresa->nombre }}
                </div>
                <div class="mb-4">
                    <strong>Razón Social:</strong> {{ $empresa->razon_social }}
                </div>
                <div class="mb-4">
                    <strong>Dirección ID:</strong> {{ $empresa->direccion_id }}
                </div>
                <div class="mb-4">
                    <strong>Color:</strong> {{ $empresa->color }}
                </div>
                <div class="mb-4">
                    <strong>Logo:</strong><br>
                    @if($empresa->ruta_logo)
                        <img src="{{ asset($empresa->ruta_logo) }}" alt="Logo" class="h-20">
                    @else
                        No hay logo disponible.
                    @endif
                </div>
                <div class="mb-4">
                    <strong>Activa:</strong> {{ $empresa->activa ? 'Sí' : 'No' }}
                </div>
                <!-- Botón de regreso -->
                <a href="{{ route('empresas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                    Atrás
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
