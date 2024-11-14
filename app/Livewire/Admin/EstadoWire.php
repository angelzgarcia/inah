<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Estado\CreateForm;
use App\Livewire\Forms\Estado\UpdateForm;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EstadoWire extends Component
{
    use WithFileUploads, WithPagination;

    protected $listeners = ['destroy'];

    public CreateForm $estadoCreate;

    public UpdateForm $estadoUpdate;


    public function render()
    {
        return view('livewire.admin.estado-wire');
    }


    public function save()
    {
        $this -> estadoCreate -> save();
    }

    public function show()
    {

    }

    public function edit()
    {
        $this -> estadoUpdate -> edit();
    }

    public function update()
    {
        $this -> estadoUpdate -> update();
    }

    public function destroy()
    {

    }

}
