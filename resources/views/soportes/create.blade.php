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
                
                    <!-- Adjuntar Imágenes -->
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
                        <x-button id="crear-soporte-btn" class="mb-4">
                            <span id="crear-soporte-spinner" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" style="display: none;"></span>
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


    <!-- Estilos personalizados para los mensajes, botones y spinner -->
    <style>
        /* Contenedor general de los mensajes */
        #chat-messages {
            max-height: 400px; /* Ajusta según tus necesidades */
            overflow-y: auto;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        /* Estilo para mensajes del bot */
        .chat-message.bot {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .chat-message.bot .message-content {
            background-color: #e2e3e5; /* Gris claro para el bot */
            color: #000;
            padding: 5px 10px; /* Aumentar el padding vertical y horizontal */
            border-radius: 15px;
            max-width: 70%; /* Limita el ancho máximo para que sean más cortos */
            word-wrap: break-word;
            position: relative; /* Para posicionamiento relativo si es necesario */
        }

        /* Estilo para mensajes del usuario */
        .chat-message.user {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .chat-message.user .message-content {
            background-color: #84cc16; /* Color lime-500 de Tailwind */
            color: #fff;
            padding: 10px 15px;
            border-radius: 15px;
            max-width: 70%; /* Limita el ancho máximo para que sean más cortos */
            word-wrap: break-word;
        }

        /* Opcional: Ajustar la fuente y el tamaño del texto */
        .message-content {
            font-size: 14px;
            line-height: 1.4;
        }

        /* Botón personalizado con clases Tailwind */
        .btn-lime-500 {
            background-color: #84cc16; /* lime-500 */
            transition: background-color 0.3s ease;
        }

        .btn-lime-500:hover {
            background-color: #65a30d; /* lime-600 */
        }

        .btn-lime-500:focus {
            background-color: #65a30d; /* lime-600 */
            box-shadow: 0 0 0 0.2rem rgba(132, 204, 22, 0.5);
        }

        .btn-lime-500:active {
            background-color: #4d7c0f; /* lime-700 */
        }

        /* Estilos para el indicador de carga (spinner) */
        .loading-dots {
            display: flex;
            align-items: center; /* Centrar verticalmente */
            justify-content: center; /* Centrar horizontalmente */
            height: 24px; /* Asegura que el contenedor tenga suficiente altura */
        }

        .loading-dots .dot {
            width: 8px;
            height: 8px;
            margin: 0 4px; /* Margen horizontal */
            background-color: #84cc16; /* lime-500 */
            border-radius: 50%;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .loading-dots .dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        .loading-dots .dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes bounce {
            0%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-8px);
            }
        }
    </style>


    <!-- Modal para el chat con ITPlusBot -->
    <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"><!-- Aumentamos el tamaño del modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="display: none;"></button>
                    <h5 class="modal-title" id="chatModalLabel">Chat con ITPlusBot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="display: none;"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenedor de la imagen y el texto -->
                    <div class="container">
                        <div class="row">
                            <!-- Columna de la imagen -->
                            <div class="col-md-3 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/itplusbot.webp') }}" class="img-fluid" alt="itplusbot">
                            </div>
                            <!-- Columna del texto -->
                            <div class="col-md-9">
                                <p class="text-start mb-4">
                                    Hola, soy <strong>ITPlusBot</strong>, tu asistente virtual especializado en ayudarte a redactar tu problema de la forma más clara y concisa posible.
                                    Estoy aquí para entender y parafrasear tu situación, asegurándome de que el equipo técnico pueda brindarte la mejor asistencia posible.
                                </p>
                                <p class="blockquote-footer text-start">
                                    Ten en cuenta que este chat será guardado para asegurar un mejor seguimiento de tu caso.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Resto del contenido del modal -->
                    <div id="chat-messages" class="mb-4 text-gray-700">
                        <!-- Aquí se cargarán los mensajes del chat -->
                    </div>
                    <!-- Campo de entrada y botones de enviar y finalizar -->
                    <div class="d-flex mt-3">
                        <input type="text" id="chat-input" class="form-control me-2 border border-lime-300 focus:border-lime-500 focus:ring-lime-500 p-2 rounded" placeholder="Escribe tu mensaje...">
                        <button id="send-chat-btn" type="button" class="btn btn-lime-500 text-white rounded hover:bg-lime-600 focus:bg-lime-600 active:bg-lime-700 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 transition ease-in-out duration-150 me-2">Enviar</button>
                        <button id="end-chat-btn" type="button" class="btn btn-danger text-white rounded hover:bg-danger-600 focus:bg-danger-600 active:bg-danger-700 focus:outline-none focus:ring-2 focus:ring-danger-500 focus:ring-offset-2 transition ease-in-out duration-150" data-bs-toggle="tooltip" data-bs-placement="top" title="Finalizar Chat">
                            <!-- Ícono de 'X' utilizando Bootstrap Icons -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.146a.5.5 0 0 1 .708 0L8 7.293l5.146-5.147a.5.5 0 1 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Finalizar Chat -->
    <div class="modal fade" id="confirmEndChatModal" tabindex="-1" aria-labelledby="confirmEndChatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Finalizar Chat</h5>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas finalizar el chat? Esto cerrará el ticket y no podrás describir tu problema nuevamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirm-end-chat-btn" class="btn btn-danger">Finalizar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Confirmación para Cerrar el Chat -->
    <div class="modal fade" id="confirmCloseModal" tabindex="-1" aria-labelledby="confirmCloseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmCloseModalLabel">Confirmar Cierre del Chat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas cerrar el chat? No habrá oportunidad de cambiarlo.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirm-close-chat-btn" class="btn btn-danger">Sí, cerrar chat</button>
                </div>
            </div>
        </div>
    </div>


<!-- Scripts -->
@push('scripts')
<!-- Agrega este script en tu archivo Blade o en tu sección de scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var soporteForm = document.querySelector("#soporte-form");
        var crearSoporteBtn = document.getElementById("crear-soporte-btn");
        var crearSoporteSpinner = document.getElementById("crear-soporte-spinner");
        var isSubmitting = false; // Flag para evitar múltiples envíos
        var loadingMessageCounter = 0; // Contador para IDs únicos
        var soporteId; // Declarar soporteId globalmente

        // Botones y modales
        var closeChatBtn = document.getElementById("close-chat-btn");
        var confirmCloseModal = new bootstrap.Modal(document.getElementById('confirmCloseModal'));
        var confirmCloseChatBtn = document.getElementById("confirm-close-chat-btn");
        var chatModalElement = document.getElementById('chatModal');
        var chatModal = new bootstrap.Modal(chatModalElement, {
            backdrop: 'static',
            keyboard: false
        });

        // Estado del chat
        var isChatFinalizado = false;

        // Agregar el event listener al formulario
        soporteForm.addEventListener("submit", handleFormSubmit);

        // Manejar el evento de envío del formulario usando async/await
        async function handleFormSubmit(e) {
            e.preventDefault();
            e.stopPropagation();

            if (isSubmitting) {
                return; // Si ya se está enviando, no permitir más envíos
            }

            isSubmitting = true;

            // Mostrar el spinner y deshabilitar el botón
            crearSoporteSpinner.style.display = 'inline-block';
            crearSoporteBtn.disabled = true;

            try {
                if (soporteForm.checkValidity()) {
                    var formData = new FormData(soporteForm);

                    // Enviar el formulario vía AJAX
                    let response = await fetch("{{ route('soportes.store') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    let data = await response.json();

                    if (data.success) {
                        soporteId = data.soporte.id; // Asignar el soporteId

                        // Llamar a ChatGPT para obtener una respuesta
                        let chatResponse = await fetch("{{ route('chat.ask') }}", {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                message: data.soporte.descripcion,
                                soporte_id: soporteId // Incluir soporte_id
                            })
                        });

                        let chatData = await chatResponse.json();

                        if (chatData.response) {
                            // Inicializar el modal con opciones para no cerrarlo
                            chatModal.show();

                            // Añadir el mensaje inicial de respuesta del bot al contenedor de mensajes
                            addMessageToChat('bot', chatData.response);
                        } else if (chatData.error) {
                            alert('Error al obtener respuesta del chat: ' + chatData.error);
                        }
                    } else {
                        alert('Error al crear el soporte: ' + data.message);
                    }
                } else {
                    soporteForm.reportValidity();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error al crear el soporte.');
            } finally {
                // Ocultar el spinner y habilitar el botón después de finalizar la solicitud
                crearSoporteSpinner.style.display = 'none';
                crearSoporteBtn.disabled = false;
                isSubmitting = false;
            }
        }

        // Función para agregar mensajes al chat
        function addMessageToChat(role, content) {
            var chatMessages = document.getElementById('chat-messages');
            var messageElement = document.createElement('div');
            var messageContent = document.createElement('div');

            // Asignar la clase base
            messageContent.classList.add('message-content');

            if (role === 'user') {
                messageElement.classList.add('chat-message', 'user');
                messageContent.innerText = content;
            } else if (role === 'bot') {
                messageElement.classList.add('chat-message', 'bot');
                // Verificar si el contenido contiene "CHAT FINALIZADO"
                if (content.includes('CHAT FINALIZADO')) {
                    isChatFinalizado = true;
                    content = content.replace('CHAT FINALIZADO', '').trim();
                    messageContent.innerText = content;
                    // Deshabilitar input y botones
                    document.getElementById('chat-input').disabled = true;
                    document.getElementById('send-chat-btn').disabled = true;
                    // Permitir cerrar el modal
                    chatModalElement.querySelector('.btn-close').style.display = 'block';
                } else {
                    messageContent.innerText = content;
                }
            }

            messageElement.appendChild(messageContent);
            chatMessages.appendChild(messageElement);

            // Desplazar automáticamente hacia abajo para ver el mensaje más reciente
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Función para agregar el indicador de carga del bot
        function addLoadingMessage() {
            loadingMessageCounter++; // Incrementar el contador para un ID único
            var currentLoadingMessageID = 'bot-loading-message-' + loadingMessageCounter;

            var chatMessages = document.getElementById('chat-messages');
            var messageElement = document.createElement('div');
            var messageContent = document.createElement('div');

            // Asignar las clases
            messageElement.classList.add('chat-message', 'bot');
            messageElement.id = currentLoadingMessageID; // Asignar un ID único

            messageContent.classList.add('message-content');
            messageContent.innerHTML = `
                <div class="loading-dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            `;

            messageElement.appendChild(messageContent);
            chatMessages.appendChild(messageElement);

            // Desplazar automáticamente hacia abajo para ver el mensaje más reciente
            chatMessages.scrollTop = chatMessages.scrollHeight;

            return currentLoadingMessageID; // Devolver el ID único
        }

        // Manejar el envío de mensajes adicionales en el chat
        document.getElementById('send-chat-btn').addEventListener('click', async function () {
            var chatInput = document.getElementById('chat-input');

            if (chatInput.value.trim() !== '') {
                var userMessage = chatInput.value.trim();

                // Añadir el mensaje del usuario al chat
                addMessageToChat('user', userMessage);

                // Vaciar el campo de entrada después de enviar el mensaje
                chatInput.value = '';

                // Añadir el mensaje de carga del bot y obtener su ID único
                var loadingMessageID = addLoadingMessage();

                try {
                    let response = await fetch("{{ route('chat.ask') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            message: userMessage,
                            soporte_id: soporteId // Incluir soporte_id
                        })
                    });

                    let chatData = await response.json();

                    if (chatData.response) {
                        // Reemplazar el mensaje de carga con la respuesta del bot
                        var loadingMessage = document.getElementById(loadingMessageID);
                        if (loadingMessage) {
                            var messageContent = loadingMessage.querySelector('.message-content');
                            var responseText = chatData.response;

                            if (responseText.includes('CHAT FINALIZADO')) {
                                isChatFinalizado = true;
                                responseText = responseText.replace('CHAT FINALIZADO', '').trim();
                                document.getElementById('chat-input').disabled = true;
                                document.getElementById('send-chat-btn').disabled = true;
                                // Mostrar el botón de cerrar si estaba oculto
                                chatModalElement.querySelector('.btn-close').style.display = 'block';
                            }

                            messageContent.innerText = responseText;

                            // Desplazar automáticamente hacia abajo para ver el mensaje más reciente
                            var chatMessages = document.getElementById('chat-messages');
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        } else {
                            // Si no se encuentra el mensaje de carga, simplemente añadir el mensaje del bot
                            addMessageToChat('bot', chatData.response);
                        }
                    } else if (chatData.error) {
                        alert('Error en el chat: ' + chatData.error);
                    }
                } catch (error) {
                    console.error('Error en el chat:', error);
                    alert('Error al interactuar con el chat.');
                    // Opcional: eliminar el mensaje de carga si hay error
                    var loadingMessage = document.getElementById(loadingMessageID);
                    if (loadingMessage) {
                        loadingMessage.remove();

                        // Ajustar el scroll después de eliminar el mensaje de carga
                        var chatMessages = document.getElementById('chat-messages');
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                }
            }
        });

        // Event listener para el botón "Finalizar Chat"
        closeChatBtn.addEventListener('click', function () {
            // Mostrar el modal de confirmación
            confirmCloseModal.show();
        });

        // Event listener para confirmar el cierre del chat
        confirmCloseChatBtn.addEventListener('click', async function () {
            // Cerrar el modal de confirmación
            confirmCloseModal.hide();

            // Enviar mensaje para finalizar el chat
            var finalizarMessage = 'quiero finalizar el chat';

            // Añadir el mensaje del usuario al chat
            addMessageToChat('user', finalizarMessage);

            // Añadir el mensaje de carga del bot y obtener su ID único
            var loadingMessageID = addLoadingMessage();

            try {
                let response = await fetch("{{ route('chat.ask') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        message: finalizarMessage,
                        soporte_id: soporteId // Incluir soporte_id
                    })
                });

                let chatData = await response.json();

                if (chatData.response) {
                    // Reemplazar el mensaje de carga con la respuesta del bot
                    var loadingMessage = document.getElementById(loadingMessageID);
                    if (loadingMessage) {
                        var messageContent = loadingMessage.querySelector('.message-content');
                        var responseText = chatData.response;

                        if (responseText.includes('CHAT FINALIZADO')) {
                            isChatFinalizado = true;
                            responseText = responseText.replace('CHAT FINALIZADO', '').trim();
                            document.getElementById('chat-input').disabled = true;
                            document.getElementById('send-chat-btn').disabled = true;
                            // Mostrar el botón de cerrar si estaba oculto
                            chatModalElement.querySelector('.btn-close').style.display = 'block';
                        }

                        messageContent.innerText = responseText;

                        // Desplazar automáticamente hacia abajo para ver el mensaje más reciente
                        var chatMessages = document.getElementById('chat-messages');
                        chatMessages.scrollTop = chatMessages.scrollHeight;

                        // Si el chat está finalizado, permitir cerrar el modal
                        if (isChatFinalizado) {
                            chatModal.hide();
                        }

                        var url = "{{ route('soportes.index')}}";
                        // Redirige a la URL generada
                        alert("El soporte fue creado con exito.")
                        window.location.href = url;
                    } else {
                        // Si no se encuentra el mensaje de carga, simplemente añadir el mensaje del bot
                        addMessageToChat('bot', chatData.response);
                    }
                } else if (chatData.error) {
                    alert('Error al finalizar el chat: ' + chatData.error);
                }
            } catch (error) {
                console.error('Error en el chat:', error);
                alert('Error al interactuar con el chat.');
                // Opcional: eliminar el mensaje de carga si hay error
                var loadingMessage = document.getElementById(loadingMessageID);
                if (loadingMessage) {
                    loadingMessage.remove();

                    // Ajustar el scroll después de eliminar el mensaje de carga
                    var chatMessages = document.getElementById('chat-messages');
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            }
        });

    });
    </script>
    
@endpush
    

</x-app-layout>
