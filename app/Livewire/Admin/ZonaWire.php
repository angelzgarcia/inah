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

    protected $listeners = ['destroy', 'updateDireccion'];

    public CreateForm $zonaCreate;

    public UpdateForm $zonaUpdate;

    public
    $openShow = false,
    $fotoKey,
    $zona,
    $estado,
    $cultura,
    $query = '',
    $perPage = 5;

    public function render()
    {
        $zonas = Zona::with('fotos')
                        -> where('nombre', 'like', "%{$this -> query}%")
                        -> orderBy('idZonaArqueologica', 'desc')
                        -> paginate($this -> perPage < 1 ? 5 : $this -> perPage, pageName: 'pageZonas');

        $culturas = Cultura::select(['idCultura', 'nombre'])
                            -> orderBy('nombre', 'asc')
                            -> get();

        $estados = Estado::select(['idEstadoRepublica', 'nombre'])
                            -> orderBy('nombre', 'asc')
                            -> get();

        $nCulturas = Cultura::count();
        $nEstados = Estado::count();

        $this -> dispatch('address', $this -> zonaCreate -> direccion);

        return view('livewire.admin.zona-wire', compact('zonas', 'culturas', 'estados', 'nCulturas', 'nEstados'));
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

    public function show($zonaID)
    {
        $this -> cargarEstadoCultura($zonaID);

        $this -> openShow = true;
    }

    public function edit($zonaID)
    {
        $zona = Zona::find($zonaID);
        $this -> zona = $zona;

        $this -> zonaUpdate -> edit($zonaID);
    }

    public function update()
    {
        $this -> zonaUpdate -> update();
    }

    public function destroy()
    {

    }

    public function cargarEstadoCultura($zonaID)
    {
        $zona = Zona::find($zonaID);
        $this -> zona = $zona;

        $this -> estado =
            Estado::select(['idEstadoRepublica', 'nombre'])
                    -> where('idEstadoRepublica', $this -> zona -> idEstadoRepublica)
                    -> first();

        $this -> cultura =
            Cultura::select(['idCultura', 'nombre'])
                    -> where('idCultura', $this -> zona -> idCultura)
                    -> first();
    }

    // reiniciar la paginacion cuando se consulte el buscador
    public function updatedQuery()
    {
        $this->resetPage('pageZonas');
    }

    // cargar la direccion del buscador de google
    public function updateDireccion($direccion)
    {
        $this -> zonaCreate -> direccion = $direccion;
    }

    public function redirigir($route)
    {
        return $this -> redirect($route, navigate:true);
    }

}
