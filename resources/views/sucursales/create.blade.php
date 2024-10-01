<!-- resources/views/sucursales/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Sucursal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('sucursales.store') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                        <input type="text" id="nombre" name="nombre" maxlength="100" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Activa -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="activa" name="activa" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                        <label for="activa" class="ml-2 block text-sm text-gray-900">Activa</label>
                    </div>

                    <!-- Dirección -->
                    <div class="mb-4">
                        <label for="direccion_id" class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                        <select name="direccion_id" id="direccion_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Seleccione una dirección</option>
                            @foreach($direcciones as $direccion)
                                <option value="{{ $direccion->id }}">{{ $direccion->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sucursal Padre -->
                    <div class="mb-4">
                        <label for="sucursal_id" class="block text-gray-700 text-sm font-bold mb-2">Sucursal Padre</label>
                        <select name="sucursal_id" id="sucursal_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Seleccione una sucursal padre</option>
                            @foreach($sucursales as $s)
                                <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Empresa -->
                    <div class="mb-4">
                        <label for="empresa_id" class="block text-gray-700 text-sm font-bold mb-2">Empresa</label>
                        <select name="empresa_id" id="empresa_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Seleccione una empresa</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                            Crear Sucursal
                        </button>
                        <a href="{{ route('sucursales.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                            Atrás
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
