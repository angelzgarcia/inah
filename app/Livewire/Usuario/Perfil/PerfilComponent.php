<?php

namespace App\Livewire\Usuario\Perfil;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PerfilComponent extends Component
{
    public $usuario;

    public function mount()
    {
        $this -> usuario = Auth::user();
    }

    public function render()
    {
        return view('livewire.usuario.perfil.perfil-component');
    }

    public function logout()
    {
        Auth::logout();
        session() -> invalidate();
        session() -> regenerateToken();

        return $this -> redirigir('login');
    }

    public function redirigir($route)
    {

        return $this -> redirect($route, navigate:true);
    }

}
