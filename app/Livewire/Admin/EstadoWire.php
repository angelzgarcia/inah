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
    $tripticoKey;


    // renderizar la vista del componente
    public function render()
    {
        $estados = Estado::orderBy('idEstadoRepublica', 'desc')
                            -> paginate(5, pageName: 'pageEstados');
        return view('livewire.admin.estado-wire', compact('estados'));
    }

    public function save()
    {
        if ($this -> estadoCreate -> save())
            $this -> dispatch('est-event', icon: 'success', title: 'Estado agregado con éxito');
        // else
        //     $this -> dispatch('est-event', icon: 'error', title: 'Contacta con soporte, ocurrió un error');

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
