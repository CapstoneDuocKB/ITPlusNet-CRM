<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Detalles de la Comuna') }}
    </h2>
</x-slot>

<div class="py-12">
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="mb-4">
            <strong>ID:</strong> {{ $comuna->id }}
        </div>
        <div class="mb-4">
            <strong>Nombre:</strong> {{ $comuna->nombre }}
        </div>
        <div class="mb-4">
            <strong>Región:</strong>
            {{ $comuna->region->nombre ?? 'N/A' }}
        </div>
        <a href="{{ route('comunas.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-600
            border border-transparent rounded-md font-semibold text-white
            hover:bg-gray-700">
            Atrás
        </a>
    </div>
</div>
</div>
</x-app-layout>
