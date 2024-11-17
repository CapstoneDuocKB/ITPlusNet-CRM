<!-- resources/views/soportes/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Soporte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Mostrar mensajes de error -->
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('soportes.store') }}" enctype="multipart/form-data" id="soporte-form">
                    @csrf
                
                    <div class="flex flex-wrap -mx-4">
                
                        <!-- Celular -->
                        <div class="w-full md:w-1/2 mb-6 px-4">
                            <x-label for="celular" value="{{ __('Teléfono') }}" />
                            <x-input id="celular" placeholder="Ingrese su Teléfono" class="block mt-1 w-full" type="text" name="celular" maxlength="12" :value="old('celular')" required />
                        </div>
                
                        <!-- Email -->
                        <div class="w-full md:w-1/2 mb-6 px-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" placeholder="Ingrese su Correo Electrónico" class="block mt-1 w-full" type="email" name="email" maxlength="45" :value="old('email')" required />
                        </div>
                    </div>
                
                    <!-- Descripción -->
                    <div class="mb-4">
                        <x-label for="descripcion" value="{{ __('Descripción') }}" />
                        <x-textarea id="descripcion" name="descripcion" rows="5" maxlength="4000" required class="mb-4 text-gray-700">{{ old('descripcion') }}</x-textarea>
                    </div>
                
                    <!-- Adjuntar Imágenes con Dropzone -->
                    <div class="mb-4">
                        <x-label value="{{ __('Adjuntar Imágenes') }}" />
                        <x-image-upload label="Subir Fotos del Producto" />
                    </div>
                
                    <!-- Urgente -->
                    <label for="urgente" class="mb-4 flex items-center">
                        <x-checkbox id="urgente" name="urgente" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Urgente') }}</span>
                    </label>
    
                
                    <!-- Botones -->
                    <div class="flex items-center justify-end">
                        <x-button class="mb-4">
                            {{ __('Crear Soporte') }}
                        </x-button>
                        {{-- <a href="{{ route('soportes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Atrás
                        </a> --}}
                    </div>
                
                </form>
                
            </div>
        </div>
    </div>

   

    @stack('scripts')

</x-app-layout>
