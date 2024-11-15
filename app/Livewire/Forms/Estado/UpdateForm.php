<?php

namespace App\Livewire\Forms\Estado;

use App\Models\Estado;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateForm extends Form
{


    #[Rule('required|string|unique:estados,nombre|max:30|min:5|regex: /^[\pL\s]+$/u')]
    public $nombre;

    #[Rule('required|string|unique:estados,capital|max:30|min:5|regex: /^[\pL\s]+$/u')]
    public $capital;

    #[Rule('required|image|mimes:svg,jpeg,jpg,png,webp|max:10000')]
    public $foto;

    #[Rule('required|url')]
    public $video;

    #[Rule('required|mimes:pdf|max:10500')]
    public $triptico;

    #[Rule('required|mimes:pd|max:10500')]
    public $guia;

    public
    $openEdit = false,
    $fotoKey,
    $estado;


    public function edit(Estado $estado)
    {
        $this-> estado = $estado;
        $this -> openEdit = true;
        $this -> fill($estado -> only(
            [
                'nombre',
                'capital',
                'video',
            ]
        ));
    }

    public function update()
    {

    }
}
