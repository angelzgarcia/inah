<?php

namespace App\Livewire\Forms\Cultura;

use App\Models\Cultura;
use App\Models\CulturaEstado;
use App\Models\CulturaImagen;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateForm extends Form
{
    #[Rule('required|string|min:5|max:50|unique:culturas,nombre|regex: /^[\pL\s]+$/u')]
    public $nombre;

    #[Rule('required|max:80|min:20')]
    public $periodo;

    #[Rule('required|max:255|min:10')]
    public $significado;

    #[Rule('required|max:1024|min:200')]
    public $descripcion;

    #[Rule('required|max:1000|min:50')]
    public $aportaciones;

    #[Rule('required|array|min:2|max:4|distinct|max:10000')]
    public $imagenes = [];

    #[Rule('required|min:1|array|distinct')]
    public $estadosID = [];

    public
    $openCreate = false,
    $openStatesSelect = false;


    // guardar cultura
    public function save()
    {
        $this -> validate();

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

            $this -> storeCulturaEstado($this -> estadosID, $cultura->idCultura);

            $this -> reset();

            return true;

        } else {
            $this -> reset([
                'nombre',
                'periodo',
                'significado',
                'descripcion',
                'aportaciones',
            ]);
        }
    }

    // crear y guardar relacion con estados|
    public function saveEstado($idEstado)
    {
        if (in_array($idEstado, $this -> estadosID))
            $this -> estadosID = array_filter($this -> estadosID, fn($id) => $id !== $idEstado);
        else
            $this -> estadosID[] = $idEstado;

        $this -> validate();
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

    // guardar cultura estado
    public function storeCulturaEstado($estadosID, $idCultura)
    {
        foreach ($estadosID as $idEstado) {
            $estadoCultura = new CulturaEstado();
            $estadoCultura -> idCultura = $idCultura;
            $estadoCultura -> idEstadoRepublica = $idEstado;
            $estadoCultura -> save();
        }
    }

    // mensajes para las relgas de validacion de cada atributo
    protected function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 50 caracteres.',
            'nombre.unique' => 'El nombre ya está registrado en otra cultura.',
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

            'imagenes.required' => 'Debes subir al menos dos imagen.',
            'imagenes.min' => 'Debes subir al menos dos imágenes.',
            'imagenes.max' => 'No puedes subir más de cuatro imágenes.',
            'imagenes.distinct' => 'Las imágenes deben ser diferentes entre sí.',
            'imagenes.*.max' => 'Cada imagen no puede exceder los 10 MB.',
            'imagenes.*.image' => 'Cada archivo debe ser una imagen.',
            'imagenes.*.mimes' => 'Cada imagen debe ser de tipo jpg, jpeg, png o webp.',

            'estadosID.required' => 'La relación con al menos un estado es obligatoria.',
            'estadosID.min' => 'Debes seleccionar al menos un estado.',
        ];
    }

}
