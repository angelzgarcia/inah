<?php

namespace App\Livewire\Forms;

use App\Models\Cultura;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CulturaUpdateForm extends Form
{
    public
    $nombre,
    $periodo,
    $significado,
    $descripcion,
    $aportaciones,
    $openEdit = false,
    $imgs_count,
    $imgs_update = [],
    $to_eliminate_imgs = [],
    $imgs_nuevas = [],
    $sweet = [];

    public function edit(Cultura $cultura)
    {
        $this -> openEdit = true;
        $this -> imgs_count = count($cultura -> fotos);
        $this -> fill($cultura -> only([
            'nombre',
            'periodo',
            'significado',
            'descripcion',
            'aportaciones',
        ]));
    }

    public function update()
    {
        // $this->cultura->update($this->culturaEdit);
        // $imgs_nuevas_count = count($this -> imgs_nuevas);
        // if ($this -> imgs_count + $imgs_nuevas_count > 4) {
            return false;
        // }
        // return;
        // dd($this->sweet);
        // }

        // if ($this -> imgs_nuevas) {
        //     dd($imgs_nuevas_count);
        // }
        // $this -> reset(['cultura', 'openEdit', 'culturaEdit']);
    }

}
