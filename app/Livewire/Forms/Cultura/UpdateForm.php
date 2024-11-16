<?php

namespace App\Livewire\Forms\Cultura;

use App\Models\Cultura;
use App\Models\CulturaImagen;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateForm extends Form
{
    #[Rule('required|string|min:3|max:50|regex: /^[\pL\s]+$/u')]
    public $nombre;

    #[Rule('required|max:80|min:20')]
    public $periodo;

    #[Rule('required|max:255|min:10')]
    public $significado;

    #[Rule('required|max:1024|min:200')]
    public $descripcion;

    #[Rule('required|max:1000|min:50')]
    public $aportaciones;

    #[Rule('nullable|max:4|distinct|max:10000')]
    public $imgs_nuevas = [];

    public
    $openEdit = false,
    $imgs_count,
    $imgs_update = [],
    $to_eliminate_imgs = [],
    $fotoKey,
    $cultura;

    public function edit(Cultura $cultura)
    {
        $this -> openEdit = true;
        $this -> cultura = $cultura;
        $this -> imgs_count = count($cultura -> fotos);
        $this -> fill($this -> cultura -> only(
[
                'nombre',
                'periodo',
                'significado',
                'descripcion',
                'aportaciones',
            ]
        ));

        // $this -> validate() -> reset();
    }

    public function update()
    {
        $this -> validate(
    [
                'nombre' => ValidationRule::unique('culturas', 'nombre')
                                            ->ignore($this->cultura->idCultura, 'idCultura')
            ]
        );

        $this -> cultura -> update($this -> only(
'nombre',
            'periodo',
            'significado',
            'descripcion',
            'aportaciones',
        ));

        $imgs_nuevas_count = count($this -> imgs_nuevas);
        $imgs_to_el_count = count($this -> to_eliminate_imgs);
        $imgs_update_count = count($this -> imgs_update);

        if ($imgs_nuevas_count  > 0 || $imgs_to_el_count  > 0 || $imgs_update_count > 0 ) {

            // si la suma de las imagenes actuales y las que se quieren agregar superan las 4 imagenes, se rechaza la peticion
            if ($this -> imgs_count + $imgs_nuevas_count - $imgs_to_el_count > 4) {
                $this -> resetImagenes();
                return 'max-img';
            }

            // si se quiere eliminar la misma cantidad de imagenes que se quiere agregar
            if ($imgs_to_el_count == $imgs_nuevas_count) {
                $this -> uploadElimianteImage();
                return;
            }

            // si las imagenes que se quieren eliminar son en igual cantidad a las actuales o si la resta de las actuales menos las que se quieren eliminar es menor a 2 se rechaza
            if (($imgs_to_el_count + $imgs_nuevas_count ==  $this -> imgs_count) || ($this -> imgs_count - $imgs_to_el_count + $imgs_nuevas_count < 2)) {
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

            // eliminar
            if ($imgs_to_el_count > 0)
                foreach($this -> to_eliminate_imgs as $id => $valor) $this -> eliminateImage($id);

            // agreagar
            if ($imgs_nuevas_count > 0)
                foreach($this -> imgs_nuevas as $img) $this -> uploadImage($img);
        }

        $this -> reset();

        return true;
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
