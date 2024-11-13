<?php

namespace App\Livewire\Forms;

use App\Models\Cultura;
use App\Models\CulturaImagen;
use Illuminate\Support\Facades\Storage;
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
    $fotoKey,
    $cultura;

    public function edit(Cultura $cultura)
    {
        $this -> openEdit = true;
        $this -> cultura = $cultura;
        $this -> imgs_count = count($cultura -> fotos);
        $this -> fill($cultura -> only(
[
                'nombre',
                'periodo',
                'significado',
                'descripcion',
                'aportaciones',
            ]
        ));
    }

    public function update()
    {
        $imgs_nuevas_count = count($this -> imgs_nuevas);
        $imgs_to_el_count = count($this -> to_eliminate_imgs);
        $imgs_update_count = count($this -> imgs_update);

        // si la suma de las imagenes actuales y las que se quieren agregar superan las 4 imagenes, se rechaza la peticion
        if ($this -> imgs_count + $imgs_nuevas_count > 4) {
            $this -> resetImagenes();
            return 'max-img';
        }

        // si se quiere eliminar la misma cantidad de imagenes que se quiere agregar
        if ($imgs_to_el_count == $imgs_nuevas_count) {
            $this -> uploadElimianteImage();
            return;
        }

        // si las imagenes que se quieren eliminar son en igual cantidad a las actuales o si la resta de las actuales menos las que se quieren eliminar es menor a 2 se rechaza
        if (($imgs_to_el_count ==  $this -> imgs_count) || ($this -> imgs_count - $imgs_to_el_count < 2)){
            $this -> resetImagenes();
            return 'min-img';
        }

        // si las imagenes que se quieren eliminar, subir, actualzar y las actuales son exactamente igual en cantidad,
        // se borran las seleccionadas y se agregan las nuevas. Las actualizadas se ignoran.
        if
            (
                !empty($this -> to_eliminate_imgs) &&
                ($this -> imgs_count == $imgs_to_el_count &&
                $this -> imgs_count == $imgs_update_count &&
                $this -> imgs_count == $imgs_nuevas_count)
            ) { $this -> uploadElimianteImage(); return; }

        // si las que se quieren eliminar son exactamnte igual a las que se quieren actualizar
        if ($imgs_update_count == $imgs_to_el_count) {
            if ($imgs_to_el_count > 2) return 'min-img';

            foreach ($this -> to_eliminate_imgs as $clave => $img) $this -> eliminateImage($clave);
        }

        // actualizar
        if ($imgs_update_count > 0)
            foreach($this -> imgs_update as $id => $img) $this -> updateImage($id, $img);

        // agreagar
        if ($imgs_nuevas_count > 0)
            foreach($this -> imgs_nuevas as $img) $this -> uploadImage($img);

        // eliminar
        if ($imgs_to_el_count > 0)
            foreach($this -> to_eliminate_imgs as $id => $valor) $this -> eliminateImage($id);

        $this -> reset();
    }

    public function uploadElimianteImage()
    {
        foreach ($this -> imgs_nuevas as $clave => $new_img)
            $this -> uploadImage($new_img); // guardar 1 imagen

        foreach ($this -> to_eliminate_imgs as $clave => $img)
            $this -> eliminateImage($clave); // eliminar 1 imagen

        $this -> resetImagenes();
    }

    public function uploadImage($new_img)
    {
        $cultureImage = new CulturaImagen();
        $cultureImage -> foto = basename(time() .'-'. $new_img -> store('img/uploads', 'public'));
        $cultureImage -> idCultura = $this -> cultura -> idCultura;
        $cultureImage -> save();
    }

    public function updateImage($id, $new_img)
    {
        $img = CulturaImagen::where('idCulturaFoto', $id) -> first();
        Storage::disk('public') -> delete("img/uploads/{$img -> foto}");
        $img -> foto = basename(time() . '-' . $new_img -> store('img/uploads', 'public'));
        $img -> update();
    }

    public function eliminateImage($id)
    {
        $image = CulturaImagen::where('idCulturaFoto', $id) -> first();
        if ($image) {
            Storage::disk('public') -> delete("img/uploads/{$image -> foto}");
            $image -> delete();
        }
    }

    public function resetImagenes()
    {
        $this -> reset(['to_eliminate_imgs', 'imgs_update', 'imgs_nuevas']);
        $this -> fotoKey = rand();
    }

}
