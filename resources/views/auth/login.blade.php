<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" onsubmit="onSubmitForm(event)">
            @csrf

            <div>
                <x-label for="rut" value="{{ __('Rut') }}" />
                <x-input id="rut" placeholder="Ingrese su Rut" class="block mt-1 w-full" type="text" name="rut" oninput="onRutInput(event)" onblur="onRutBlur(event)" :value="old('rut')" required autofocus autocomplete="username" />
                <p id="rut-error-message" class="text-red-500 text-sm mt-1 hidden">RUT inválido</p>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" placeholder="Ingrese su Contraseña" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
            
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
                @endif
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Mantener sesión iniciada') }}</span>
                </label>

            </div>
                
                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('register'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500" href="{{ route('register') }}">
                            {{ __('¿Aun no tienes una cuenta? Regístrate') }}
                        </a>
                    @endif
                <x-button class="ms-4">
                    {{ __('Acceder') }}
                </x-button>
            </div>
        </form>

    </x-authentication-card>

    <!-- Cargar el script al final -->
    <script src="{{ asset('js/rutValidator.js') }}" type="text/javascript"></script>
</x-guest-layout>
