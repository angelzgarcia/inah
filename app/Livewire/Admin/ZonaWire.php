<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Zona\CreateForm;
use App\Livewire\Forms\Zona\UpdateForm;
use App\Models\Zona;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ZonaWire extends Component
{
    use WithFileUploads, WithPagination;

    protected $listener = ['destroy'];

    public CreateForm $zonaCreate;

    public UpdateForm $zonaUpdate;

    public
    $openShow = false,
    $zona;

    public function render()
    {
        $zonas = Zona::orderBy('nombre', 'asc') -> paginate(5);

        return view('livewire.admin.zona-wire', compact('zonas'));
    }
}
