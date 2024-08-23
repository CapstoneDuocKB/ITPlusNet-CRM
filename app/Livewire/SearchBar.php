<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBar extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $results = [];
    
        if (strlen($this->searchTerm) > 2) {
            $routes = [
                'Lista de Usuarios' => route('users.index'),
                'Lista de Soportes' => route('supports.index'),
                'Lista de Empresas' => route('companies.index'),
                'Editar Perfil' => route('profile.edit'),
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
        logger()->info('Término de búsqueda: ' . $this->searchTerm);
        logger()->info('Resultados: ' . json_encode($results));
    
        return view('livewire.search-bar', [
            'results' => $results,
            'searchTerm' => $this->searchTerm,
        ]);
    }
    
}