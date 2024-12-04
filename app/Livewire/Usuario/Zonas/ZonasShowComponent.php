<?php

namespace App\Livewire\Usuario\Zonas;

use App\Models\Zona;
use Livewire\Component;

class ZonasShowComponent extends Component
{
    public
    $idZona;

    public function mount($idZona)
    {
        $this -> idZona = $idZona;
    }

    public function render()
    {
        $zona = Zona::find($this -> idZona);

        return view('livewire.usuario.zonas.zonas-show-component', compact('zona'));
    }
}
