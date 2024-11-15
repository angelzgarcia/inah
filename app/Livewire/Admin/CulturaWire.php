<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Cultura\CreateForm;
use App\Livewire\Forms\Cultura\UpdateForm;
use App\Models\Cultura;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class CulturaWire extends Component
{
    use WithFileUploads, WithPagination;

    protected $listeners = ['destroy'];

    public CreateForm $culturaCreate;

    public UpdateForm $culturaUpdate;

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

    // crear y guardar
    public function save()
    {
        $validate = $this -> culturaCreate -> save();

        if ($validate)
            $this -> dispatch('cult-event', icon:'success', title:'Cultura agregada con éxito');
        else
            $this -> dispatch('cult-event', icon:'error', title:'Contacta con soporte, ocurrió un error');

        $this -> fotoKey = rand();
    }

    // ver detalles
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
        $validate = $this -> culturaUpdate -> update();

        if (isset($validate)) {
            $data = match ($validate) {
                'max-img' => [
                    'icon' => 'info',
                    'title' => 'Máximo 4 imagenes',
                ],
                'min-img' => [
                    'icon' => 'info',
                    'title' => 'Deja al menos 2 imagenes',
                ],
                true => [
                    'icon' => 'success',
                    'title' => 'Cultura actualizada'
                ]
            };
            $this -> dispatch('cult-event', icon: $data['icon'], title: $data['title']);
        }
    }

    // confirmar eliminacio
    public function confirmDestroy($idCultura)
    {
        $this -> dispatch('conf-event', $idCultura);
    }

    // eliminar
    public function destroy(Cultura $cultura)
    {
        $cultura -> delete();

        $this -> dispatch('cult-event', icon:'success', title:'Cultura eliminada');
    }

}
