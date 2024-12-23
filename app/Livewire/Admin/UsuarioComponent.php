<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\Usuario\CreateForm;
use App\Livewire\Forms\Usuario\UpdateForm;
use App\Models\Usuario;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UsuarioComponent extends Component
{
    use WithFileUploads, WithPagination;

    protected $listeners = ['destroy'];

    public CreateForm $usuarioCreate;

    public UpdateForm $usuarioUpdate;

    public
    $openShow = false,
    $usuario,
    $fotoKey,
    $query = '',
    $perPage = 5,
    $sortColumn = 'idUsuario',
    $sortDirection = 'desc';

    public function render()
    {
        $usuarios = Usuario::where('idUsuario', 'like', "%{$this -> query}%")
                            -> orWhere('status', 'like', "%{$this -> query}%")
                            -> orWhere('nombre', 'like', "%{$this -> query}%")
                            -> orWhere('email', 'like', "%{$this -> query}%")
                            -> orderBy($this -> sortColumn, $this -> sortDirection)
                            -> paginate($this -> perPage, pageName:'pageUsuarios');

        $nUsuarios = Usuario::count();

        return view('livewire.admin.usuario-component', compact('usuarios', 'nUsuarios'));
    }

    public function save()
    {
        $validate = $this -> usuarioCreate -> save();

        if ($validate)
            $this -> dispatch('user-event', icon: 'success', title: "Registro exitoso.\nSolicite confirmar la cuenta.");
        else
            $this -> dispatch('user-event', icon: 'error', title: 'Ocurrió un error inesperado. Contacte con soporte');
    }

    public function show($idUsuario)
    {
        $this -> usuario = Usuario::find($idUsuario);

        $this -> openShow = true;
    }

    public function edit($idUsuario)
    {
        $this -> usuarioUpdate -> edit($idUsuario);
    }

    public function update()
    {
        $validate = $this -> usuarioUpdate -> update();

        if($validate) $this -> dispatch('user-event', icon: 'success', title: 'Usuario actualizado con éxito');

        else $this -> dispatch('user-event', icon: 'error', title: 'Ocurrió un error, contacta con soporte por favor');
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

    // reiniciar la paginacion cuando se consulte el buscador
    public function updatedQuery()
    {
        $this -> resetPage('pageUsuarios');
    }

    public function redirigir()
    {
        return $this -> redirect(route('database'), navigate: true);
    }

}
