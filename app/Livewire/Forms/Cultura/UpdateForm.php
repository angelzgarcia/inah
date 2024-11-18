<?php

namespace App\Livewire\Forms\Cultura;

use App\Models\Cultura;
use App\Models\CulturaEstado;
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

    #[Rule('nullable|max:4|distinct|array|max:10000')]
    public $imgs_nuevas = [];

    #[Rule('nullable|max:4|distinct|array')]
    public $imgs_update = [];

    #[Rule('nullable|max:4|distinct|array')]
    public $to_eliminate_imgs = [];

    // ids de los estados actuales relacionados a la cultura actual
    #[Rule('required|min:1|array|distinct')]
    public $estadosActualesID = [];

    #[Rule('nullable|array|distinct')]
    public $estadosUpdateID = [];

    #[Rule('nullable|array|distinct')]
    public $estadosRemovedID = [];


    public
    $openEdit = false,
    $openStatesSelect = false,
    $imgs_count,
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
        $this -> validate(
    [
                'nombre' => ValidationRule::unique('culturas', 'nombre')
                                            -> ignore($this->cultura->idCultura, 'idCultura')
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
            if (($imgs_to_el_count  > 1 && ($imgs_to_el_count + $imgs_nuevas_count ==  $this -> imgs_count)) || ($this -> imgs_count - $imgs_to_el_count + $imgs_nuevas_count < 2)) {
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
            if ((($imgs_update_count > 2 && $imgs_to_el_count > 2) && ($imgs_to_el_count  == $imgs_update_count)) || $imgs_to_el_count > 2) {
                return 'min-img';

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

        // agregar nuevas relaciones con estados
        if(!empty($this->estadosUpdateID))
            foreach ($this->estadosUpdateID as $estadoID)
                CulturaEstado::create([
                    'idCultura' => $this -> cultura -> idCultura,
                    'idEstadoRepublica' => $estadoID,
                ]);

        // eliminar relaciones existentes
        if(!empty($this->estadosRemovedID))
            foreach ($this->estadosRemovedID as $estadoID)
                CulturaEstado::where('idCultura', $this -> cultura -> idCultura)
                                -> where('idEstadoRepublica', $estadoID)
                                -> delete();

        $this -> reset();

        return true;
    }

    public function updateEstados($idEstado)
    {
        if (in_array($idEstado, $this->estadosActualesID)) {
            // Si pertenece a los estados actuales, moverlo a estadosRemovedID
            if (in_array($idEstado, $this->estadosRemovedID)) {
                // Si ya estaba en removidos, quitarlo de ahí (volver a seleccionarlo)
                $this->estadosRemovedID = array_filter(
                    $this->estadosRemovedID,
                    fn($id) => $id !== $idEstado
                );
            } else {
                // Si no estaba en removidos, agregarlo
                $this->estadosRemovedID[] = $idEstado;
            }
        } else {
            // Si no pertenece a los estados actuales, es un nuevo estado
            if (in_array($idEstado, $this->estadosUpdateID)) {
                // Quitar de nuevos si ya estaba seleccionado
                $this->estadosUpdateID = array_filter(
                    $this->estadosUpdateID,
                    fn($id) => $id !== $idEstado
                );
            } else {
                // Agregar a nuevos seleccionados
                $this->estadosUpdateID[] = $idEstado;
            }
        }

        $this->validate();
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

    // mensajes para las relgas de validacion de cada atributo
    protected function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            'periodo.required' => 'El periodo es obligatorio.',
            'periodo.max' => 'El periodo no puede exceder de 80 caracteres.',
            'periodo.min' => 'El periodo debe tener al menos 20 caracteres.',

            'significado.required' => 'El significado es obligatorio.',
            'significado.max' => 'El significado no puede exceder de 255 caracteres.',
            'significado.min' => 'El significado debe tener al menos 10 caracteres.',

            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.max' => 'La descripción no puede exceder de 1024 caracteres.',
            'descripcion.min' => 'La descripción debe tener al menos 200 caracteres.',

            'aportaciones.required' => 'Las aportaciones son obligatorias.',
            'aportaciones.max' => 'Las aportaciones no pueden exceder de 1000 caracteres.',
            'aportaciones.min' => 'Las aportaciones deben tener al menos 50 caracteres.',

            'imgs_nuevas.max' => 'No puedes subir más de cuatro imágenes.',
            'imgs_nuevas.distinct' => 'Las imágenes deben ser diferentes entre sí.',
            'imgs_nuevas.*.max' => 'Cada imagen no puede exceder los 10 MB.',
            'imgs_nuevas.*.image' => 'Cada archivo debe ser una imagen.',
            'imgs_nuevas.*.mimes' => 'Cada imagen debe ser de tipo jpg, jpeg, png o webp.',

            'estadosActualesID.required' => 'La relación con al menos un estado es obligatoria.',
            'estadosActualesID.min' => 'Debes seleccionar al menos un estado.',
        ];
    }

}
