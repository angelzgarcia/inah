<?php

namespace App\Livewire\Usuario\Estados;

use App\Models\Estado;
use Livewire\Component;

class EstadosComponent extends Component
{
    public $query = '';


    public function render()
    {
        $estados = Estado::where('nombre', 'like', "%{$this->query}%")
                            ->orderBy('nombre', 'asc')
                            -> paginate(10, pageName: 'pageEstados');

        return view('livewire.usuario.estados.estados-component', compact('estados'));
    }

    public function redirigir($idEstado)
    {
        $estado = Estado::find($idEstado);

        return $this -> redirect(route('estado.show', compact('estado')));
    }

}
