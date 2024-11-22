<?php

namespace App\Livewire\Usuario\Estados;

use App\Models\Estado;
use Livewire\Component;

class EstadosComponent extends Component
{
    public function render()
    {
        $estados = Estado::orderBy('nombre', 'desc')
                            -> paginate(10, pageName: 'pageEstados');

        return view('livewire.usuario.estados.estados-component', compact('estados'));
    }
}
