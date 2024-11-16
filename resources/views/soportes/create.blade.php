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

    <!-- Configuración de Dropzone -->
    @push('scripts')
    <!-- Incluye las librerías de Dropzone desde CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Deshabilita el auto-descubrimiento de Dropzone
            Dropzone.autoDiscover = false;

            // Configura Dropzone
            var myDropzone = new Dropzone("#dropzone", {
                url: "{{ route('soportes.upload') }}",
                autoProcessQueue: false, // Procesar la cola manualmente
                uploadMultiple: true,
                parallelUploads: 5,
                maxFiles: 5,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                dictRemoveFile: 'Eliminar',
                dictCancelUpload: 'Cancelar',
                dictDefaultMessage: 'Arrastra aquí tus imágenes para subirlas',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                init: function() {
                    var submitButton = document.querySelector("#submit-all");
                    var soporteForm = document.querySelector("#soporte-form");
                    var soporteIdInput = document.querySelector("#soporte_id");

                    // Manejar el evento de clic en el botón de envío
                    submitButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Validar el formulario antes de procesar la cola de Dropzone
                        if (soporteForm.checkValidity()) {
                            // Crear una instancia de FormData y agregar los datos del formulario
                            var formData = new FormData(soporteForm);

                            // Enviar el formulario vía AJAX para crear el soporte
                            fetch("{{ route('soportes.store') }}", {
                                method: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                    'Accept': 'application/json'
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Asignar el soporte_id al campo oculto
                                    soporteIdInput.value = data.soporte_id;

                                    // Procesar la cola de Dropzone para subir las imágenes
                                    myDropzone.processQueue();
                                } else {
                                    alert('Error al crear el soporte.');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Error al crear el soporte.');
                            });
                        } else {
                            // Mostrar errores de validación del formulario
                            soporteForm.reportValidity();
                        }
                    });

                    // Añadir el soporte_id al FormData de cada archivo antes de enviarlo
                    this.on("sendingmultiple", function(data, xhr, formData) {
                        formData.append("soporte_id", soporteIdInput.value);
                    });

                    // Manejar el evento de éxito en la carga de imágenes
                    this.on("successmultiple", function(files, response) {
                        // Opcional: Redirigir o mostrar un mensaje de éxito
                        window.location.href = "{{ route('soportes.index') }}";
                    });

                    // Manejar errores en la carga de imágenes
                    this.on("errormultiple", function(files, response) {
                        alert('Error al subir las imágenes.');
                    });

                    // Manejar el evento de agregar un archivo
                    this.on("addedfile", function(file) {
                        var defaultMessage = document.querySelector('.dz-message');
                        if (defaultMessage) {
                            defaultMessage.style.display = 'none';
                        }
                    });

                    // Manejar el evento de eliminar un archivo
                    this.on("removedfile", function(file) {
                        if (this.files.length === 0) {
                            var defaultMessage = document.querySelector('.dz-message');
                            if (defaultMessage) {
                                defaultMessage.style.display = 'block';
                            }
                        }
                    });
                }
            });
        });
    </script>

    <!-- Estilos CSS personalizados para Dropzone -->
    <style>
        /* Ocultar detalles innecesarios de Dropzone */
        .dz-size, .dz-filename, .dz-error-message {
            display: none !important;
        }

        /* Estilo personalizado para el botón de eliminar */
        .dz-remove {
            display: block;
            padding: 5px 10px;
            color: red;
            border: 2px solid red;
            background-color: transparent;
            border-radius: 4px;
            text-align: center;
            width: 80px;
            font-weight: bold;
            cursor: pointer;
            margin: 0 auto; /* Centrar el botón */
            margin-top: 0; /* Reducir el espacio entre la imagen y el botón */
        }

        .dz-remove:hover {
            background-color: red;
            color: white;
        }

        /* Ajustes de vista previa */
        .dz-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 0; /* Eliminar espacio adicional */
        }

        .dz-image {
            margin-bottom: 0; /* Eliminar espacio entre imagen y botón */
        }

        .dz-details {
            display: block;
        }
    </style>

    @endpush

    @stack('scripts')

</x-app-layout>
