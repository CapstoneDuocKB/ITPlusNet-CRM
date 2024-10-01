<!-- resources/views/empresas/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('empresas.update', $empresa->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- RUT -->
                    <div class="mb-4">
                        <label for="rut" class="block text-gray-700 text-sm font-bold mb-2">RUT</label>
                        <input type="text" id="rut" name="rut" value="{{ $empresa->rut }}" maxlength="12" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="{{ $empresa->nombre }}" maxlength="50" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Razón Social -->
                    <div class="mb-4">
                        <label for="razon_social" class="block text-gray-700 text-sm font-bold mb-2">Razón Social</label>
                        <input type="text" id="razon_social" name="razon_social" value="{{ $empresa->razon_social }}" maxlength="150" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Dirección -->
                    <div class="mb-4">
                        <label for="direccion_id" class="block text-gray-700 text-sm font-bold mb-2">Dirección</label>
                        <select name="direccion_id" id="direccion_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Seleccione una dirección</option>
                            @foreach($direcciones as $direccion)
                                <option value="{{ $direccion->id }}" {{ $empresa->direccion_id == $direccion->id ? 'selected' : '' }}>{{ $direccion->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Color -->
                    <div class="mb-4">
                        <label for="color" class="block text-gray-700 text-sm font-bold mb-2">Color</label>
                        <input type="text" id="color" name="color" value="{{ $empresa->color }}" maxlength="20" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Ruta Logo -->
                    <div class="mb-4">
                        <label for="ruta_logo" class="block text-gray-700 text-sm font-bold mb-2">Logo</label>
                        @if($empresa->ruta_logo)
                            <div class="mb-2">
                                <img src="{{ asset($empresa->ruta_logo) }}" alt="Logo" class="h-20">
                            </div>
                        @endif
                        <input type="file" id="ruta_logo" name="ruta_logo" accept="image/*" class="block w-full text-gray-700">
                    </div>

                    <!-- Activa -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="activa" name="activa" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ $empresa->activa ? 'checked' : '' }}>
                        <label for="activa" class="ml-2 block text-sm text-gray-900">Activa</label>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                            Actualizar Empresa
                        </button>
                        <a href="{{ route('empresas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                            Atrás
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
