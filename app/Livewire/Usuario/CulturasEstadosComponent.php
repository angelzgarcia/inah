<?php

namespace App\Livewire\Usuario;

use App\Models\Cultura;
use App\Models\CulturaEstado;
use App\Models\Estado;
use Livewire\Component;

class CulturasEstadosComponent extends Component
{
    public
    $idEstado,
    $cultura,
    $openShow = false;

    public function mount($idEstado)
    {
        $this -> idEstado = $idEstado;
    }

    public function render()
    {
        $idCulturas = CulturaEstado::select('idCultura')
                                    -> where('idEstadoRepublica', $this -> idEstado)
                                    -> get();

        $culturas = Cultura::whereIn('idCultura', $idCulturas)
                            -> with('fotos')
                            -> paginate(8, pageName:'culturasPage');
                            // dd($culturas);

        $estado = Estado::select('nombre')
                        -> where('idEstadoRepublica', $this -> idEstado)
                        -> first();

        return view('livewire.usuario.culturas-estados-component', compact('culturas', 'estado'));
    }

    public function show($idCultura)
    {
        $this -> cultura = Cultura::find($idCultura);

        $this -> openShow = true;
    }


}
