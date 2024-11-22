<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserMain extends Component
{
    public
    $title,
    $user,
    $src_maps,
    $js,
    $hiddenNav,
    $hiddenFoot;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $user = null, $src_maps = null, $js = null, $hiddenNav = false, $hiddenFoot = false)
    {
        $this->title = $title;
        $this->user = $user;
        $this->src_maps = $src_maps;
        $this->js = $js;
        $this->hiddenNav = $hiddenNav;
        $this->hiddenFoot = $hiddenFoot;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.user-main');
    }
}
