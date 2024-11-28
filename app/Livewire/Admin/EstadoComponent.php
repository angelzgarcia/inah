<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Estado\CreateForm;
use App\Livewire\Forms\Estado\UpdateForm;
use App\Models\CulturaEstado;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Cultura;
use Livewire\Component;
use App\Models\Estado;

class EstadoComponent extends Component
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
    $culturasActuales,
    $query = '',
    $perPage = 5,
    $sortColumn = 'idEstadoRepublica',
    $sortDirection = 'desc';

    // reinicia la paginacion cuando se consulte el buscador en cualquir pagina
    public function updatedQuery()
    {
        $this -> resetPage('pageEstados');
    }

    // renderizar la vista del componente
    public function render()
    {
        $estados = Estado::where('nombre', 'like', "%{$this -> query}%")
                            -> orWhere('capital', 'like', "%{$this -> query}%")
                            -> orWhere('idEstadoRepublica', 'like', "%{$this -> query}%")
                            -> orderBy($this -> sortColumn, $this -> sortDirection)
                            -> paginate($this -> perPage < 1 ? 5 : $this -> perPage, pageName: 'pageEstados');

        $nEstados = Estado::count();

        $nCulturas = Cultura::count();

        $culturasRegistradas = Cultura::select(['idCultura', 'nombre'])
                                        -> paginate(16, pageName: 'pageCulturas');

        return view('livewire.admin.estado-component', compact('estados', 'nCulturas', 'nEstados', 'culturasRegistradas'));
    }

    public function save()
    {
        $response = $this -> estadoCreate -> save();

        match ($response) {
            'video' => $this -> dispatch('est-event', icon: 'info', title: 'Este video ya está registrado'),
            $this -> estadoCreate -> nombre => $this -> dispatch('est-event', icon: 'warning', title: 'No se pudieron obtener las coordenadas para "'. $response . '"'),
            true => $this -> dispatch('est-event', icon: 'success', title: 'Estado agregado con éxito'),
            default => $this -> dispatch('est-event', icon: 'error', title: 'Error inesperado, contacta con soporte por favor'),
        };

        $this -> fotoKey = rand();
        $this -> guiaKey = rand();
        $this -> tripticoKey = rand();
    }

    public function show(Estado $estado)
    {
        $this -> estado = $estado;

        $this -> cargarCulturasRelacionados($estado -> idEstadoRepublica);

        if ($estado->ubicacion) {
            $this->dispatch('openModal', [
                'lat' => $estado->ubicacion->latitud,
                'lng' => $estado->ubicacion->longitud,
            ]);
        } else {
            $this->dispatch('openModal', [
                'lat' => 0,
                'lng' => 0,
            ]);
        }

        $this -> openShow = true;
    }

    public function edit(Estado $estado)
    {
        $this -> estado = $estado;

        $this -> cargarCulturasRelacionados($estado -> idEstadoRepublica);

        // se envian solo los id de las culturas, no los modelos completos
        $this -> estadoUpdate -> culturasActualesID = $this
                                                -> culturasActuales
                                                -> pluck('idCultura')
                                                -> toArray();

        $this -> estadoUpdate -> edit($estado);
    }

    public function update()
    {
        $validate = $this -> estadoUpdate -> update();

        if ($validate)
            return $this -> dispatch('est-event', icon: 'success', title: 'Estado actualizado con éxito');

        else
            return $this -> dispatch('est-event', icon: 'error', title: 'No se pudo obtener una ubicación para "' . $this -> estadoUpdate -> nombre . '"');
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

    public function saveCultura($idCultura)
    {
        $this -> estadoCreate -> saveCulturas($idCultura);
    }

    public function updateCultura($idCultura)
    {
        $this -> estadoUpdate -> updateCulturas($idCultura);
    }

    // cargar la relacion con culturas
    public function cargarCulturasRelacionados($estadoID)
    {
        // se seleccionan los id de los estados relacionados a la cultura actual consultada. se obtienen los modelos
        $culturasEstados = CulturaEstado::select('idCultura')
                                        -> where('idEstadoRepublica', $estadoID)
                                        -> get();

        // se extraen solo los ids de los modelos extraidos anteriormente
        $idsCulturas = $culturasEstados -> pluck('idCultura');

        // se seleccionan los estados con los ids obtenidos antes
        $this -> culturasActuales = Cultura::select(['idCultura', 'nombre'])
                                        -> whereIn('idCultura', $idsCulturas)
                                        -> get();
    }

    // ordenar registros
    public function sortBy($idColumnName)
    {
        if ($this -> sortColumn == $idColumnName) {
            $this -> sortDirection = $this -> sortDirection == 'desc' ? 'asc' : 'desc';
        } else {
            $this -> sortColumn = $idColumnName;
            $this -> sortDirection = 'desc';
        }
    }

    public function redirigir($route)
    {
        return $this -> redirect(route($route), navigate: true);
    }

}
