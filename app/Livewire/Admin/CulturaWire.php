<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Cultura\CreateForm;
use App\Livewire\Forms\Cultura\UpdateForm;
use App\Models\Cultura;
use App\Models\Estado;
use Illuminate\Support\Facades\Schema;
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
    $fotoKey,
    $cultura,
    $query = '',
    $perPage = 5;

    // reiniciar la paginacion cuando se consulte el buscador
    public function updatedQuery()
    {
        $this->resetPage('pageCulturas');
    }

    // renderizar la vista
    public function render()
    {
        $culturas = Cultura::with('fotos')
                            -> where('nombre', 'like', "%{$this->query}%")
                            -> orWhere('idCultura', 'like', "%{$this->query}%")
                            -> orderBy('idCultura', 'desc')
                            -> paginate($this->perPage < 1 ? 5 : $this -> perPage, pageName: 'pageCulturas');

        $cols = Schema::getColumnListing('culturas');

        $nEstados = Estado::count();

        $estados = Estado::select(['idEstadoRepublica', 'nombre']) -> paginate(pageName: 'estadosPage');

        return view('livewire.admin.cultura-wire', compact('culturas', 'cols', 'nEstados', 'estados'));
    }

    // crear y guardar relacion con estados
    public function saveEstado($idEstado)
    {
        $this -> culturaCreate -> saveEstado($idEstado);
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
