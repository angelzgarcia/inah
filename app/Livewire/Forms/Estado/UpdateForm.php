<?php

namespace App\Livewire\Forms\Estado;

use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateForm extends Form
{

    #[Rule('required|string|unique:estados,nombre|max:50|min:5')]
    public $nombre;

    #[Rule('required|image|mimes:svg,jpeg,jpg,png,webp|max:10000')]
    public $foto;

    #[Rule('nullable')]
    public $video;

    #[Rule('required|pdf')]
    public $triptico;

    #[Rule('required|pdf')]
    public $guia;

    public function edit()
    {

    }

    public function update()
    {

    }
}
