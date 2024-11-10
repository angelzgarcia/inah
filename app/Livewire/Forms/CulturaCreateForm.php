<?php

namespace App\Livewire\Forms;

use App\Models\Cultura;
use App\Models\CulturaImagen;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CulturaCreateForm extends Form
{
    public
    $nombre,
    $periodo,
    $significado,
    $descripcion,
    $aportaciones,
    $openCreate = false,
    $imagenes = [];

    public function save()
    {
        if ($this -> imagenes) {
            $cultura = Cultura::create(
        $this  -> only(
        'nombre',
                    'periodo',
                    'significado',
                    'descripcion',
                    'aportaciones',
                )
            );
            $this -> storeImg($this -> imagenes, $cultura);
        }

        $this -> reset();
    }

    // guardar imagenes
    public function storeImg($imgs_arr_name, $cultura) {
        foreach($imgs_arr_name as $foto) {
            $cultureImage = new CulturaImagen();
            $cultureImage -> foto = basename(time() .'-'. $foto -> store('img/uploads', 'public'));
            $cultureImage -> idCultura = $cultura -> idCultura;
            $cultureImage -> save();
        }
    }

}
