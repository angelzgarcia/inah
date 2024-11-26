<?php

namespace App\Livewire\Admin;

use App\Models\CulturaEstado;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class CulturaEstadoComponent extends Component
{
    public
    $openShow = false,
    $perPage = 5,
    $query = '',
    $sortColumn = 'idCulturaEstado',
    $sortDirection = 'desc',
    $cultura_estado;

    public function render()
    {
        $culturas_estados = CulturaEstado::where('idCulturaEstado', 'like', "%{$this -> query}%")
                                        -> orderBy($this -> sortColumn, $this -> sortDirection)
                                        -> paginate($this -> perPage < 1 ? 5 : $this -> perPage, pageName: 'pageCulturasEstados');

                                        // dd($culturas_estados);
        $keys = Schema::getColumnListing('culturas_estados');

        return view('livewire.admin.cultura-estado-component', compact('culturas_estados', 'keys'));
    }

    public function show($idCulturaEstado)
    {
        $this -> cultura_estado = CulturaEstado::find($idCulturaEstado) -> first();

        $this -> openShow = true;
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
        return $this -> redirect(route($route), navigate: true);
    }
}
