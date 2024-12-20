<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Crear Comuna') }}
    </h2>
</x-slot>

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <form method="POST" action="{{ route('comunas.store') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label for="nombre"
                    class="block text-gray-700 text-sm font-bold mb-2">
                    Nombre
                </label>
                <input type="text" id="nombre" name="nombre" maxlength="100"
                    required class="block w-full bg-white border border-gray-300
                    rounded-md shadow-sm focus:outline-none focus:ring-indigo-500
                    focus:border-indigo-500">
            </div>

            <!-- Región -->
            <div class="mb-4">
                <label for="region_id"
                    class="block text-gray-700 text-sm font-bold mb-2">
                    Región
                </label>
                <select name="region_id" id="region_id" required
                    class="block w-full bg-white border border-gray-300
                    rounded-md shadow-sm focus:outline-none focus:ring-indigo-500
                    focus:border-indigo-500">
                    <option value="">Seleccione una región</option>
                    @foreach($regiones as $region)
                        <option value="{{ $region->id }}">
                            {{ $region->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600
                    border border-transparent rounded-md font-semibold text-white
                    hover:bg-indigo-700">
                    Crear Comuna
                </button>
                <a href="{{ route('comunas.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600
                    border border-transparent rounded-md font-semibold text-white
                    hover:bg-gray-700">
                    Atrás
                </a>
            </div>
        </form>
    </div>
</div>
</div>
</x-app-layout>
