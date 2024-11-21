<?php

namespace App\Livewire\Forms\Estado;

use App\Models\UbicacionEstado;
use Livewire\Attributes\Rule;
use App\Models\CulturaEstado;
use App\Models\Estado;
use Livewire\Form;
// use Illuminate\Validation\Rule;
// use Livewire\Attributes\Validate;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Validation\Rule as ValidationRule;

class CreateForm extends Form
{

    #[Rule('required|string|unique:estados,nombre|max:30|min:5|regex: /^[\pL\s]+$/u')]
    public $nombre;

    #[Rule('required|string|unique:estados,capital|max:30|min:5|regex: /^[\pL\s]+$/u')]
    public $capital;

    #[Rule('required|image|mimes:jpeg,jpg,png,webp|max:10000')]
    public $foto;

    #[Rule('required|url|unique:estados,video|regex:/^(https:\/\/www\.youtube\.com\/watch\?v=[\w-]+(?:&[\w-]+=[\w-]+)*)$/')]
    public $video;

    #[Rule('required|mimes:pdf|max:15000','triptico', 'triptico')]
    public $triptico;

    #[Rule('required|mimes:pdf|max:10500')]
    public $guia;

    #[Rule('nullable|array|distinct')]
    public $culturasID = [];

    public
    $openCreate = false,
    $openCulturasCheck = false;


    public function save()
    {
        $this -> validate();

        $video = Estado::where('video',  $this -> cleanYouTubeUrl($this -> video)) -> first();

        if (!empty($video)) return 'video';

        $coords = getCoordinates($this -> nombre);
        if (!$coords) return $this -> nombre;

        if (isset($this -> foto, $this -> guia, $this -> triptico)) {

            $foto = basename(time() . '-' . $this -> foto -> store('img/uploads', 'public'));
            $triptico =  $this -> triptico -> storeAs('tripticos', $this -> triptico -> getClientOriginalName() . '-' . time() , 'public');
            $guia =  $this -> guia -> storeAs('guias', $this -> guia -> getClientOriginalName() . '-' . time() ,'public');

            $estado = Estado::create(
    [
                    'nombre' => $this -> nombre,
                    'capital' => $this -> capital,
                    'foto' => $foto,
                    'video' => $this -> cleanYouTubeUrl($this -> video),
                    'triptico' => basename($triptico),
                    'guia' => basename($guia),
                ]
            );

            if (!empty($this -> culturasID))
                foreach ($this->culturasID as $idCultura)
                    CulturaEstado::create([
                        'idCultura' => $idCultura,
                        'idEstadoRepublica' => $estado -> idEstadoRepublica,
                    ]);

            UbicacionEstado::create([
                'latitud' => $coords['lat'],
                'longitud' => $coords['lng'],
                'idEstadoRepublica' => $estado -> idEstadoRepublica,
            ]);

            $this -> reset();

            return true;
        }
    }

    public function saveCulturas($idCultura)
    {
        if (in_array($idCultura, $this -> culturasID))
            $this -> culturasID = array_filter($this -> culturasID, fn($id) => $id !== $idCultura);
        else
            $this -> culturasID[] = $idCultura;

        $this -> validate();
    }

    public function cleanYouTubeUrl($url)
    {
        $parsedUrl = parse_url($url);

        if (isset($parsedUrl['host']) && strpos($parsedUrl['host'], 'youtube.com') !== false) {
            if (isset($parsedUrl['query'])) {
                parse_str($parsedUrl['query'], $queryParams);
                if (isset($queryParams['v'])) {
                    return 'https://www.youtube.com/embed/' . $queryParams['v'];
                }
            }
        }

        return null;
    }

    // mensajes para las reglas de validacion
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto.',
            'nombre.unique' => 'El estado ya está registrado.',
            'nombre.max' => 'El nombre no puede tener más de 30 caracteres.',
            'nombre.min' => 'El nombre debe tener al menos 5 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            'capital.required' => 'La  capital es obligatorio.',
            'capital.string' => 'La capital debe ser un texto.',
            'capital.unique' => 'La capital ya está registrada.',
            'capital.max' => 'La capital no puede tener más de 30 caracteres.',
            'capital.min' => 'La capital debe tener al menos 5 caracteres.',
            'capital.regex' => 'La capital solo puede contener letras y espacios.',

            'foto.required' => 'La  foto es obligatoria.',
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'La foto debe ser de tipo: svg, jpeg, jpg, png o webp.',
            'foto.max' => 'La foto no puede exceder los 10 MB.',

            'video.required' => 'El  video es obligatorio.',
            'video.url' => 'El video debe ser una URL válida.',
            'video.unique' => 'Esta URL ya está registrada  .',

            'triptico.required' => 'El  tríptico es obligatorio.',
            'triptico.mimes' => 'El tríptico debe ser un archivo PDF.',
            'triptico.max' => 'El tríptico no puede exceder los 15 MB.',
        ];
    }

}
