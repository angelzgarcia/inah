<?php

namespace App\Livewire\Admin;

use App\Models\CulturaImagen;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class CulturaFotoComponent extends Component
{
    use WithPagination;

    public
    $openShow = false,
    $query = '',
    $perPage = 5,
    $sortColumn = 'idCulturaFoto',
    $sortDirection = 'desc';

    public function render()
    {
        $culturas_fotos = CulturaImagen::where('idCulturaFoto', 'like', "%{$this -> query}%")
                                        -> orderBy($this -> sortColumn, $this -> sortDirection)
                                        -> paginate($this -> perPage < 1 ? 5 : $this -> perPage, pageName: 'pageCulturasFotos');

        return view('livewire.admin.cultura-foto-component', compact('culturas_fotos'));
    }

    // reinicia la paginacion cuando se consulte el buscador en cualquir pagina
    public function updatedQuery()
    {
        $this -> resetPage('pageCulturasFotos');
    }

    public function sortBy($idColumnName)
    {
        if ($this -> sortColumn == $idColumnName) {
            $this -> sortDirection = $this -> sortDirection == 'desc' ? 'asc' : 'desc';
        } else {
            $this -> sortColumn = $idColumnName;
            $this -> sortDirection = 'desc';
        }
    }


    public function redirigir($route)
    {
        return $this -> redirect(route($route));
    }

}
