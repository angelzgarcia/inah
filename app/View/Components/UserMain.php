<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserMain extends Component
{
    public
    $mainW,
    $title,
    $user,
    $hiddenNav,
    $hiddenFoot,
    $usarMapa;

    /**
     * Create a new component instance.
     */
    public function __construct($mainW = 95, $title = null, $user = null, $hiddenNav = false, $hiddenFoot = false, $usarMapa = false )
    {
        $this -> mainW = $mainW;
        $this -> title = $title;
        $this -> user = $user;
        $this -> hiddenNav = $hiddenNav;
        $this -> hiddenFoot = $hiddenFoot;
        $this -> usarMapa = $usarMapa;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.user-main');
    }
}
