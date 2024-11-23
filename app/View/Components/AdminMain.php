<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AdminMain extends Component
{

    public
    $title,
    $usuario,
    $usarMapa;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $usuario = null, $usarMapa = false)
    {
        $this -> title = $title;
        $this -> usuario = $usuario;
        $this -> usarMapa = $usarMapa;
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

        return redirect() -> route($route);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.admin-main');
    }
}
