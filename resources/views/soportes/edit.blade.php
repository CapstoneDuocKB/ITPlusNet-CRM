<!-- resources/views/soportes/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Soporte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('soportes.update', $soporte->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Horas Hombre -->
                    <div class="mb-4">
                        <label for="horas_hombre" class="block text-gray-700 text-sm font-bold mb-2">Horas Hombre</label>
                        <input type="number" step="0.01" id="horas_hombre" name="horas_hombre" value="{{ old('horas_hombre', $soporte->horas_hombre) }}" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- UF -->
                    <div class="mb-4">
                        <label for="uf" class="block text-gray-700 text-sm font-bold mb-2">UF</label>
                        <input type="number" step="0.01" id="uf" name="uf" value="{{ old('uf', $soporte->uf) }}" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="4" maxlength="4000" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">{{ old('descripcion', $soporte->descripcion) }}</textarea>
                    </div>

                    <!-- Solución -->
                    <div class="mb-4">
                        <label for="solucion" class="block text-gray-700 text-sm font-bold mb-2">Solución</label>
                        <textarea id="solucion" name="solucion" rows="4" maxlength="4000" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">{{ old('solucion', $soporte->solucion) }}</textarea>
                    </div>

                    <!-- Celular -->
                    <div class="mb-4">
                        <label for="celular" class="block text-gray-700 text-sm font-bold mb-2">Celular</label>
                        <input type="text" id="celular" name="celular" value="{{ old('celular', $soporte->celular) }}" maxlength="12" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $soporte->email) }}" maxlength="45" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Urgente -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="urgente" name="urgente" value="1" class="h-4 w-4 text-indigo-600" {{ old('urgente', $soporte->urgente) ? 'checked' : '' }}>
                        <label for="urgente" class="ml-2 block text-sm text-gray-900">Urgente</label>
                    </div>

                    <!-- Bodega -->
                    <div class="mb-4">
                        <label for="bodega_id" class="block text-gray-700 text-sm font-bold mb-2">Bodega</label>
                        <select name="bodega_id" id="bodega_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccione una bodega</option>
                            @foreach($bodegas as $bodega)
                                <option value="{{ $bodega->id }}" {{ old('bodega_id', $soporte->bodega_id) == $bodega->id ? 'selected' : '' }}>{{ $bodega->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Caja -->
                    <div class="mb-4">
                        <label for="caja_id" class="block text-gray-700 text-sm font-bold mb-2">Caja</label>
                        <select name="caja_id" id="caja_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccione una caja</option>
                            @foreach($cajas as $caja)
                                <option value="{{ $caja->id }}" {{ old('caja_id', $soporte->caja_id) == $caja->id ? 'selected' : '' }}>{{ $caja->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dificultad de Soporte -->
                    <div class="mb-4">
                        <label for="dificultad_soporte_id" class="block text-gray-700 text-sm font-bold mb-2">Dificultad de Soporte</label>
                        <select name="dificultad_soporte_id" id="dificultad_soporte_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccione una dificultad</option>
                            @foreach($dificultades as $dificultad)
                                <option value="{{ $dificultad->id }}" {{ old('dificultad_soporte_id', $soporte->dificultad_soporte_id) == $dificultad->id ? 'selected' : '' }}>{{ $dificultad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estado de Soporte -->
                    <div class="mb-4">
                        <label for="estado_soporte_id" class="block text-gray-700 text-sm font-bold mb-2">Estado de Soporte</label>
                        <select name="estado_soporte_id" id="estado_soporte_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccione un estado</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}" {{ old('estado_soporte_id', $soporte->estado_soporte_id) == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tipo de Soporte -->
                    <div class="mb-4">
                        <label for="tipo_soporte_id" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Soporte</label>
                        <select name="tipo_soporte_id" id="tipo_soporte_id" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm">
                            <option value="">Seleccione un tipo</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('tipo_soporte_id', $soporte->tipo_soporte_id) == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Actualizar Soporte
                        </button>
                        <a href="{{ route('soportes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                            Atrás
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
