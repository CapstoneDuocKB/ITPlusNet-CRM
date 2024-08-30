<div class="relative">
    <div class="flex items-center border border-gray-300 rounded-lg bg-gray-100">
        <!-- Icono de búsqueda -->
        <div class="p-2 bg-gray-200 border-r border-gray-300 rounded-l-lg cursor-pointer" onclick="document.getElementById('search-input').focus()">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.875-5.175a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"></path>
            </svg>
        </div>

        <!-- Campo de búsqueda -->
        <input id="search-input" type="text" 
               placeholder="Buscar..."
               class="w-full py-2 pl-4 pr-4 text-sm text-gray-900 bg-gray-100 rounded-r-lg focus:ring-lime-500 focus:border-lime-500"
               wire:model.live.debounce.1ms="searchTerm">
    </div>

    <!-- Resultados de búsqueda -->
    @if(!empty($searchTerm))
        <div class="absolute z-10 left-0 w-full bg-white border border-gray-300 mt-1 rounded-lg shadow-lg">
            @forelse($results as $result)
                <a href="{{ $result['url'] }}" class="block p-2 hover:bg-gray-200">
                    {{ $result['name'] }}
                </a>
            @empty
                <div class="block p-2 text-gray-500">
                    No se encontraron resultados
                </div>
            @endforelse
        </div>
    @endif
</div>
