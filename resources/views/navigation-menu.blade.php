<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Flex container principal -->
            <div class="flex items-center justify-between w-full">
                <!-- Logo -->
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Search Bar (centrado, oculto en pantallas pequeñas) -->
                <div class="hidden sm:flex sm:flex-grow sm:justify-center lg:w-2/3">
                    <div class="w-2/3">
                        @livewire('search-bar')
                    </div>
                </div>

                <!-- Settings Dropdown - Siempre al final -->
                <div class="flex items-center justify-end space-x-4 ml-auto">
                    <!-- Botón de usuario -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
