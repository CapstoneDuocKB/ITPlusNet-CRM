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
                <form method="POST" action="{{ route('soportes.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Bodega -->
                    <div class="mb-4">
                        <label for="bodega_id" class="block text-gray-700 text-sm font-bold mb-2">Bodega</label>
                        <select name="bodega_id" id="bodega_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Seleccione una bodega</option>
                            @foreach($bodegas as $bodega)
                                <option value="{{ $bodega->id }}">{{ $bodega->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Caja -->
                    <div class="mb-4">
                        <label for="caja_id" class="block text-gray-700 text-sm font-bold mb-2">Caja</label>
                        <select name="caja_id" id="caja_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Seleccione una caja</option>
                            @foreach($cajas as $caja)
                                <option value="{{ $caja->id }}">{{ $caja->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="5" maxlength="4000" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <!-- Celular -->
                    <div class="mb-4">
                        <label for="celular" class="block text-gray-700 text-sm font-bold mb-2">Celular</label>
                        <input type="text" id="celular" name="celular" maxlength="12" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" maxlength="45" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    

                    <!-- Adjuntar Imágenes con Dropzone -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Adjuntar Imágenes</label>
                        <div id="dropzone" class="dropzone border-dashed border-2 border-gray-300 rounded-md flex items-center justify-center cursor-pointer">
                            <div class="text-center">
                                <!-- <div class="text-5xl">+</div> -->
                                <!-- <div class="mt-2 text-sm text-gray-500">Arrastra y suelta las imágenes aquí o haz clic para seleccionar</div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Urgente -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="urgente" name="urgente" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="urgente" class="ml-2 block text-sm text-gray-900">Urgente</label>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Crear Soporte
                        </button>
                        <a href="{{ route('soportes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Atrás
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- Configuración de Dropzone -->
    @push('scripts')
<script>
    window.addEventListener('load', function () {
        // Check if Dropzone is defined
        if (typeof Dropzone !== 'undefined') {
            // Disable auto-discovery
            Dropzone.autoDiscover = false;

            // Get the element
            var dropzoneElement = document.getElementById('dropzone');

            // Initialize Dropzone
            var myDropzone = new Dropzone(dropzoneElement, {
                url: "{{ route('soportes.create') }}",
                autoProcessQueue: true,
                uploadMultiple: false,
                maxFiles: 10,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                dictRemoveFile: 'Eliminar',
                dictCancelUpload: 'Cancelar',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                init: function () {
                    this.on("success", function (file, response) {
                        // Handle success
                    });

                    this.on("error", function (file, response) {
                        // Handle error
                    });
                }
            });
        } else {
            console.error('Dropzone is not defined');
        }
    });
</script>
@endpush

    @stack('scripts')

</x-app-layout>
