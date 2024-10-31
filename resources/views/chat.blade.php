<!-- resources/views/chat.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prueba de ChatGPT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Contenido principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('chat.ask') }}">
                    @csrf

                    <!-- Mensaje para ChatGPT -->
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Escribe tu mensaje para ChatGPT</label>
                        <input type="text" id="message" name="message" maxlength="500" required class="block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="¿En qué puedo ayudarte?">
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                            Enviar
                        </button>
                        <a href="{{ url()->current() }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-white hover:bg-gray-700">
                            Limpiar
                        </a>
                    </div>

                </form>

                <!-- Mostrar la respuesta de ChatGPT si está disponible -->
                @if (session('response'))
                    <div class="mt-6 p-4 bg-green-100 border-t-4 border-green-500 rounded-b text-green-700">
                        <p class="font-bold">Respuesta de ChatGPT:</p>
                        <p>{{ session('response') }}</p>
                    </div>
                @endif

                <!-- Mostrar errores si los hay -->
                @if (session('error'))
                    <div class="mt-6 p-4 bg-red-100 border-t-4 border-red-500 rounded-b text-red-700">
                        <p class="font-bold">Error:</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
