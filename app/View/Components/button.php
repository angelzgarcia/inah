<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{

    public $class;
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct($type = 'button', $tipo = 'back')
    {
        $this->class = match ($tipo) {
            'up' => 'up',
            'back' => 'back',
            'aggregate' => 'aggregate',
            'create' => 'create',
            'edit' => 'edit',
            'update' => 'update',
            'destroy' => 'destroy',
            'cancel' => 'cancel',
        };
        // $this->class = $tipo;

        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
