<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\CulturaCreateForm;
use App\Livewire\Forms\CulturaUpdateForm;
use App\Models\Cultura;
use App\Models\CulturaImagen;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class CulturaWire extends Component
{
    use WithFileUploads, WithPagination;

    public CulturaCreateForm $culturaCreate;

    public CulturaUpdateForm $culturaUpdate;

    public
    $openShow = false,
    $cultura,
    $fotoKey;

    // renderizar la vista
    public function render()
    {
        $culturas = Cultura::with('fotos')
                            -> orderBy('idCultura', 'desc')
                            -> paginate(5, pageName: 'pageCulturas');
        return view('livewire.admin.cultura-wire', compact('culturas'));
    }

    // crear
    public function save()
    {
        $this -> culturaCreate -> save();
        $this -> fotoKey = rand();
    }

    // mostrar / ver detalles
    public function show(Cultura $cultura)
    {
        $this -> cultura = $cultura;
        $this -> openShow = true;
    }

    // editar
    public function edit(Cultura $cultura)
    {
        $this -> cultura = $cultura;
        $this -> culturaUpdate -> edit($cultura);
    }

    // actualizar
    public function update()
    {
        $this -> culturaUpdate -> update();
    }

    // eliminar
    public function destroy(Cultura $cultura)
    {
        $cultura -> delete();
    }


}
