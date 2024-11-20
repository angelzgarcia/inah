<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Zona\CreateForm;
use App\Livewire\Forms\Zona\UpdateForm;
use App\Models\Cultura;
use App\Models\Estado;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Zona;

class ZonaWire extends Component
{
    use WithFileUploads, WithPagination;

    protected $listeners = ['updateDireccion'];

    public CreateForm $zonaCreate;

    public UpdateForm $zonaUpdate;

    public
    $openShow = false,
    $fotoKey,
    $zona,
    $query = '',
    $perPage = 5;

    public function render()
    {
        $zonas = Zona::where('nombre', 'like', "%{$this -> query}%")
                        -> orderBy('nombre', 'asc')
                        -> paginate($this -> perPage < 1 ? 5 : $this -> perPage, pageName: 'zonasPage');

        $culturas = Cultura::select(['idCultura', 'nombre'])
                            -> orderBy('nombre', 'asc') -> get();

        $estados = Estado::select(['idEstadoRepublica', 'nombre'])
                            -> orderBy('nombre', 'asc') -> get();

        $nCulturas = Cultura::count();
        $nEstados = Estado::count();

        $this -> dispatch('address', $this->zonaCreate->direccion);

        return view('livewire.admin.zona-wire', compact('zonas', 'culturas', 'estados', 'nCulturas', 'nEstados'));
    }

    public function updateDireccion($direccion)
    {
        $this -> zonaCreate -> direccion = $direccion;
    }

    public function save()
    {
        $validate = $this -> zonaCreate -> save();

        match ($validate) {
            true => $this -> dispatch('zona-event', icon:'success', title:'Zona agregada con éxito'),
            'location' => $this -> dispatch('zona-event', icon:'error', title:'No pudimos obtener las coordenadas de esta zona'),
            'imgs_count' => $this -> dispatch('zona-event', icon:'error', title:'No se encontraron ficheros para subir'),
            'imgs_extension' => $this -> dispatch('zona-event', icon:'error', title:'Solo ficheros de tipo JPG, PNG, WEBP, JPEG'),
            default => $this -> dispatch('zona-event', icon:'error', title:'Contacta con soporte, ocurrió un error inesperado'),
        };

        $this -> fotoKey = rand();
    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function redirigir($route)
    {
        return $this -> redirect($route, navigate:true);
    }

}
