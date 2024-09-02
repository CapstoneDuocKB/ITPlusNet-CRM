<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
    public $searchTerm = '';

    public function render()
    {
        // El resto de tu lógica
        $results = [];

        if (strlen($this->searchTerm) > 0) {
            $routes = [
                'Editar Perfil' => route('profile.show'),
                // 'Lista de Usuarios' => route('users.index'),
                // 'Lista de Soportes' => route('supports.index'),
                // 'Lista de Empresas' => route('companies.index'),
            ];
    
            foreach ($routes as $name => $route) {
                if (stripos($name, $this->searchTerm) !== false) {
                    $results[] = [
                        'name' => $name,
                        'url' => $route,
                    ];
                }
            }
        }
    
        // Mostrar detalles para depuración
        // logger()->info('Término de búsqueda: ' . $this->searchTerm);
        // logger()->info('Resultados: ' . json_encode($results));
    
        return view('livewire.search-bar', [
            'results' => $results,
            'searchTerm' => $this->searchTerm,
        ]);

    }
}
