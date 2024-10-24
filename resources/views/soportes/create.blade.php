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

                    <!-- Bodega -->
                    <div class="mb-4">
                        <label for="bodega_id" class="block text-gray-700 text-sm font-bold mb-2">Bodega</label>
                        <select name="bodega_id" id="bodega_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Seleccione una bodega</option>
                            @foreach($bodegas as $bodega)
                                <option value="{{ $bodega->id }}" {{ old('bodega_id') == $bodega->id ? 'selected' : '' }}>{{ $bodega->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Caja -->
                    <div class="mb-4">
                        <label for="caja_id" class="block text-gray-700 text-sm font-bold mb-2">Caja</label>
                        <select name="caja_id" id="caja_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Seleccione una caja</option>
                            @foreach($cajas as $caja)
                                <option value="{{ $caja->id }}" {{ old('caja_id') == $caja->id ? 'selected' : '' }}>{{ $caja->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dificultad de Soporte -->
                    <div class="mb-4">
                        <label for="dificultad_soporte_id" class="block text-gray-700 text-sm font-bold mb-2">Dificultad de Soporte</label>
                        <select name="dificultad_soporte_id" id="dificultad_soporte_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Seleccione una dificultad</option>
                            @foreach($dificultades as $dificultad)
                                <option value="{{ $dificultad->id }}" {{ old('dificultad_soporte_id') == $dificultad->id ? 'selected' : '' }}>{{ $dificultad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estado de Soporte -->
                    <div class="mb-4">
                        <label for="estado_soporte_id" class="block text-gray-700 text-sm font-bold mb-2">Estado de Soporte</label>
                        <select name="estado_soporte_id" id="estado_soporte_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Seleccione un estado</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}" {{ old('estado_soporte_id') == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tipo de Soporte -->
                    <div class="mb-4">
                        <label for="tipo_soporte_id" class="block text-gray-700 text-sm font-bold mb-2">Tipo de Soporte</label>
                        <select name="tipo_soporte_id" id="tipo_soporte_id" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Seleccione un tipo</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('tipo_soporte_id') == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="5" maxlength="4000" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('descripcion') }}</textarea>
                    </div>

                    <!-- Solución -->
                    <div class="mb-4">
                        <label for="solucion" class="block text-gray-700 text-sm font-bold mb-2">Solución</label>
                        <textarea id="solucion" name="solucion" rows="5" maxlength="4000" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('solucion') }}</textarea>
                    </div>

                    <!-- Horas Hombre -->
                    <div class="mb-4">
                        <label for="horas_hombre" class="block text-gray-700 text-sm font-bold mb-2">Horas Hombre</label>
                        <input type="number" step="0.01" id="horas_hombre" name="horas_hombre" value="{{ old('horas_hombre') }}" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- UF -->
                    <div class="mb-4">
                        <label for="uf" class="block text-gray-700 text-sm font-bold mb-2">UF</label>
                        <input type="number" step="0.01" id="uf" name="uf" value="{{ old('uf') }}" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Celular -->
                    <div class="mb-4">
                        <label for="celular" class="block text-gray-700 text-sm font-bold mb-2">Celular</label>
                        <input type="text" id="celular" name="celular" maxlength="12" value="{{ old('celular') }}" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" maxlength="45" value="{{ old('email') }}" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Adjuntar Imágenes con Dropzone -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Adjuntar Imágenes</label>
                        <div id="dropzone" class="dropzone border-dashed border-2 border-gray-300 rounded-md flex items-center justify-center cursor-pointer"></div>
                        <input type="hidden" name="soporte_id" id="soporte_id" value="">
                    </div>

                    <!-- Urgente -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="urgente" name="urgente" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ old('urgente') ? 'checked' : '' }}>
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
