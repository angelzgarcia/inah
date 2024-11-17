<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Estado\CreateForm;
use App\Livewire\Forms\Estado\UpdateForm;
use App\Models\Estado;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EstadoWire extends Component
{
    use WithFileUploads, WithPagination;

    protected $listeners = ['destroy'];

    public CreateForm $estadoCreate;

    public UpdateForm $estadoUpdate;

    public
    $openShow = false,
    $estado,
    $fotoKey,
    $guiaKey,
    $tripticoKey,
    $query = '',
    $perPage = 5;

    // reiniciar la paginacion cuando se consulte el buscador
    public function updatedQuery()
    {
        $this->resetPage('pageEstados');
    }

    // renderizar la vista del componente
    public function render()
    {
        $estados = Estado::orderBy('idEstadoRepublica', 'desc')
                            -> where('nombre', 'like', "%{$this -> query}%")
                            -> orWhere('capital', 'like', "%{$this -> query}%")
                            -> orWhere('idEstadoRepublica', 'like', "%{$this -> query}%")
                            -> paginate($this->perPage < 1 ? 5 : $this -> perPage, pageName: 'pageEstados');

        $nEstados = Estado::count();

        return view('livewire.admin.estado-wire', compact('estados', 'nEstados'));
    }

    public function save()
    {
        if ($this -> estadoCreate -> save())
            $this -> dispatch('est-event', icon: 'success', title: 'Estado agregado con éxito');
        else
            $this -> dispatch('est-event', icon: 'error', title: 'Este video ya está registrado');

        $this -> fotoKey = rand();
        $this -> guiaKey = rand();
        $this -> tripticoKey = rand();
    }

    public function show(Estado $estado)
    {
        $this -> estado = $estado;
        $this -> openShow = true;
    }

    public function edit(Estado $estado)
    {
        $this -> estado = $estado;
        $this -> estadoUpdate -> edit($estado);
    }

    public function update()
    {
        $validate = $this -> estadoUpdate -> update();

        if ($validate)
            return $this -> dispatch('est-event', icon: 'success', title: 'Estado actualizado con éxito');

        else
            return $this -> dispatch('est-event', icon: 'error', title: 'Contacte con soporte, ocurrió un error');

    }

    public function confirmDestroy($idEstado)
    {
        $this -> dispatch('conf-event', $idEstado);
    }

    public function destroy(Estado $estado)
    {
        $estado -> delete();

        $this -> dispatch('est-event', icon: 'success', title: 'Estado eliminado con éxito');
    }

}
