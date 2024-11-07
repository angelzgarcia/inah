<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use function PHPSTORM_META\type;

class button extends Component
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
            'create' => 'create',
            'edit' => 'edit',
            'destroy' => 'destroy',
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
