<?php

namespace App\Livewire\Usuario;

use App\Models\Estado;
use App\Models\Zona;
use Livewire\Component;

class ZonasEstadosComponent extends Component
{
    public
    $idEstado,
    $cultura;

    public function mount($idEstado)
    {
        $this -> idEstado = $idEstado;
    }

    public function render()
    {
        $idZonas = Zona::select('idZonaArqueologica')
                                    -> where('idEstadoRepublica', $this -> idEstado)
                                    -> get();

        $zonas = Zona::whereIn('idZonaArqueologica', $idZonas)
                            -> with('fotos')
                            -> paginate(8, pageName:'zonasPage');

        $estado = Estado::select('nombre')
                        -> where('idEstadoRepublica', $this -> idEstado)
                        -> first();

        return view('livewire.usuario.zonas-estados-component', compact('zonas', 'estado'));
    }

    public function mostrarZona($idZona)
    {
        $estado = Estado::find($this -> idEstado);
        $zona = Zona::find($idZona);

        $slug_estado = $estado -> slug;
        $slug_zona = $zona -> slug;

        return $this -> redirect(route('zona-estado.show', compact('slug_estado', 'slug_zona')), navigate: true);
    }

}
