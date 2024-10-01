<!-- resources/views/direcciones/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Dirección') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('direcciones.store') }}">
                    @csrf

                    <!-- Calle -->
                    <div class="mb-4">
                        <label for="calle" class="block text-gray-700 text-sm font-bold mb-2">Calle</label>
                        <input type="text" id="calle" name="calle" maxlength="255" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Número -->
                    <div class="mb-4">
                        <label for="numero" class="block text-gray-700 text-sm font-bold mb-2">Número</label>
                        <input type="text" id="numero" name="numero" maxlength="20" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Comuna -->
                    <div class="mb-4">
                        <label for="comuna_id" class="block text-gray-700 text-sm font-bold mb-2">Comuna</label>
                        <select name="comuna_id" id="comuna_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Seleccione una comuna</option>
                            @foreach($comunas as $comuna)
                                <option value="{{ $comuna->id }}">{{ $comuna->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                            Crear Dirección
                        </button>
                        <a href="{{ route('direcciones.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                            Atrás
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
