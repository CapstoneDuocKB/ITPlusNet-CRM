<div class="relative">
    <input type="text" 
           placeholder="Buscar..."
           class="block w-full py-2 pl-4 pr-10 text-sm text-gray-900 bg-gray-100 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
           wire:model.debounce.300ms="searchTerm">

    @if(!empty($searchTerm))
        <div class="absolute bg-white border border-gray-300 mt-2 rounded-lg w-full">
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

    <script>
        console.log('Término de búsqueda:', @json($searchTerm));
        console.log('Resultados:', @json($results));
    </script>
</div>
