<?php

namespace App\Livewire\Admin;

use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Livewire\Forms\Cultura\CreateForm;
use App\Livewire\Forms\Cultura\UpdateForm;
use Illuminate\Support\Facades\Schema;
use App\Models\CulturaEstado;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Cultura;
use App\Models\Estado;

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
    $estadosActuales,
    $query = '',
    $perPage = 5,
    $sortColumn = 'idCultura',
    $sortDirection = 'desc';

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
                            -> orderBy($this -> sortColumn, $this -> sortDirection)
                            -> paginate($this -> perPage < 1 ? 5 : $this -> perPage, pageName: 'pageCulturas');

        $cols = Schema::getColumnListing('culturas');

        $nEstados = Estado::count();

        $estadosRegistrados = Estado::select(['idEstadoRepublica', 'nombre'])
                                    -> paginate(16, pageName: 'estadosPage');

        return view('livewire.admin.cultura-wire', compact('culturas', 'cols', 'nEstados', 'estadosRegistrados'));
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

        $this -> cargarEstadosRelacionados($cultura -> idCultura);

        $this -> openShow = true;
    }

    // editar
    public function edit(Cultura $cultura)
    {
        $this -> cultura = $cultura;

        $this -> cargarEstadosRelacionados($cultura -> idCultura);

        // se envian solo los id de los estados, no los modelos completos
        $this -> culturaUpdate -> estadosActualesID = $this
                                                -> estadosActuales
                                                -> pluck('idEstadoRepublica')
                                                -> toArray();

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

    // crear y guardar relacion con estados
    public function saveEstado($idEstado)
    {
        $this -> culturaCreate -> saveEstado($idEstado);
    }

    // crear y guardar relacion con estados
    public function updateEstado($idEstado)
    {
        $this -> culturaUpdate -> updateEstados($idEstado);
    }

    // cargar la relacion con estados
    public function cargarEstadosRelacionados($culturaID)
    {
        // se seleccionan los id de los estados relacionados a la cultura actual consultada. se obtienen los modelos
        $culturasEstados = CulturaEstado::select('idEstadoRepublica')
                                        -> where('idCultura', $culturaID)
                                        -> get();

        // se extraen solo los ids de los modelos extraidos anteriormente
        $idsEstados = $culturasEstados -> pluck('idEstadoRepublica');

        // se seleccionan los estados con los ids obtenidos antes
        $this -> estadosActuales = Estado::select(['idEstadoRepublica', 'nombre'])
                                        -> whereIn('idEstadoRepublica', $idsEstados)
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
        return $this -> redirect($route, navigate: true);
    }

}
