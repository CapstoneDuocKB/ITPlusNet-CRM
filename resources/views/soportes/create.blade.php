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
                        <div id="dropzone" class="dropzone border-dashed border-2 border-gray-300 rounded-md flex items-center justify-center cursor-pointer"></div>
                    </div>

                    <!-- Urgente -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="urgente" name="urgente" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="urgente" class="ml-2 block text-sm text-gray-900">Urgente</label>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between">
                        <button type="submit" id="submit-all" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
    document.addEventListener('DOMContentLoaded', function () {
        if (window.Dropzone && !Dropzone.instances.length) { // Verifica que Dropzone esté definido y que no haya instancias previas
            Dropzone.autoDiscover = false; // Deshabilita el auto-descubrimiento global

            var dropzoneElement = document.getElementById('dropzone');
            if (dropzoneElement && !dropzoneElement.dropzone) { // Verifica que el elemento exista y no tenga Dropzone ya asociado
                var myDropzone = new Dropzone(dropzoneElement, {
                    url: "{{ route('soportes.upload') }}", // Asegúrate de que la URL es correcta para la carga de archivos
                    autoProcessQueue: true,
                    uploadMultiple: true,
                    maxFiles: 5,
                    acceptedFiles: 'image/*',
                    addRemoveLinks: true,
                    dictRemoveFile: 'Eliminar',
                    dictCancelUpload: 'Cancelar',
                    dictDefaultMessage: 'Arrastra aquí tus archivos para subirlos', // Traducción del mensaje
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    init: function() {
                        var submitButton = document.querySelector("#submit-all");
                        myDropzone = this;

                        // Ocultar el mensaje predeterminado al agregar una imagen
                        this.on("addedfile", function(file) {
                            var defaultMessage = document.querySelector('.dz-message'); // Selecciona el mensaje predeterminado
                            if (defaultMessage) {
                                defaultMessage.style.display = 'none'; // Oculta el mensaje
                            }
                        });

                        // Mostrar el mensaje si no quedan archivos en el Dropzone después de eliminar uno
                        this.on("removedfile", function(file) {
                            if (this.files.length === 0) {
                                var defaultMessage = document.querySelector('.dz-message'); // Selecciona el mensaje predeterminado
                                if (defaultMessage) {
                                    defaultMessage.style.display = 'block'; // Vuelve a mostrar el mensaje
                                }
                            }
                        });

                        // Manejar el procesamiento de la cola de Dropzone
                        submitButton.addEventListener("click", function() {
                            myDropzone.processQueue(); // Procesar todos los archivos en cola cuando el usuario finalice el formulario
                        });

                        this.on("sendingmultiple", function(data, xhr, formData) {
                            // No necesitas agregar campos del formulario aquí si solo estás subiendo archivos
                        });
                    }
                });
            }
        }
    });
</script>

<!-- Estilos CSS personalizados -->
<style>
    /* Ocultar información no deseada (nombre, peso y objeto) */
    .dz-size, .dz-filename, .dz-details, .dz-error-message {
        display: none !important;
    }

    /* Personalizar el botón de eliminar */
    .dz-remove {
        display: block;
        margin-top: 2px; /* Reducir espacio entre la imagen y el botón */
        padding: 5px 10px;
        color: red;
        border: 2px solid red;
        background-color: transparent;
        border-radius: 4px;
        text-align: center;
        width: 80px;
        font-weight: bold;
        cursor: pointer;
        margin-left: auto;  /* Centrar el botón */
        margin-right: auto; /* Centrar el botón */
    }

    .dz-remove:hover {
        background-color: red;
        color: white;
    }

    /* Alinear el botón debajo de la imagen */
    .dz-preview {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 6px; /* Reducir el espacio en la parte inferior */
    }

    /* Ajustar el tamaño y estilo de la imagen */
    .dz-image {
        margin-bottom: 6px; /* Acercar el botón de eliminar a la imagen */
    }

    /* Asegurarse de que el contenedor de detalles esté completamente oculto */
    .dz-details {
        display: none;
    }
</style>





    @endpush

    @stack('scripts')

</x-app-layout>
