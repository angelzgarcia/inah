<?php

namespace App\Livewire\Forms\Estado;

use App\Models\Estado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateForm extends Form
{

    #[Rule('required|string|min:3|max:50|regex: /^[\pL\s]+$/u')]
    public $nombre;

    #[Rule('required|string|max:30|min:5|regex: /^[\pL\s]+$/u')]
    public $capital;

    #[Rule('nullable|mimes:jpeg,jpg,png,webp|max:10000')]
    public $foto;

    #[Rule('required|url')]
    public $video;

    #[Rule('nullable|mimes:pdf|max:10500')]
    public $triptico;

    #[Rule('nullable|mimes:pd|max:10500')]
    public $guia;

    public
    $openEdit = false,
    $fotoKey,
    $tripticoKey,
    $guiaKey,
    $estado;

    public function edit(Estado $estado)
    {
        $this -> openEdit = true;
        $this-> estado = $estado;
        $this -> fill($this -> estado -> only(
            [
                'nombre',
                'capital',
                'video',
            ]
        ));

        $this -> validate();
    }

    public function update()
    {
        $this -> validate();

        $this -> estado -> video = $this -> cleanYouTubeUrl($this -> video);

        if (isset($this -> foto))
            $this ->
                actualizarFichero("img/uploads",$this -> estado -> foto, 'foto', $this -> foto);

        if (isset($this -> triptico))
            $this ->
                actualizarFichero("tripticos",$this -> estado -> triptico , 'triptico', $this-> triptico);

        if (isset($this -> guia))
            $this ->
                actualizarFichero("guias", $this -> estado -> guia, "guia", $this -> guia);


        $this -> estado -> update($this -> only(
'nombre',
            'capital',
            'video',
        ));

        $this -> reset();

        return true;
    }

    public function actualizarFichero($ruta, $referencia, $campo, $fichero)
    {
        Storage::disk('public') -> delete("$ruta/$referencia");

        $this -> estado -> $campo = basename(
            $fichero -> storeAs($ruta, $fichero -> getClientOriginalName() . time() . '-', 'public')
        );
    }

    // se parse la url del video para poder incrustarlo en el html y que youtube no rechace la conexion
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

    public function rules()
    {
        return [
            'nombre' => [
                'required','string','min:3','max:50','regex: /^[\pL\s]+$/u',
                ValidationRule::unique('estados', 'nombre') -> ignore($this -> estado -> idEstadoRepublica, 'idEstadoRepublica')],
            'capital' => [
                'required',
                'string',
                'max:255',
                ValidationRule::unique('estados', 'capital' )-> ignore($this -> estado -> idEstadoRepublica, 'idEstadoRepublica'),
            ],
            'foto' => 'required|image|mimes:jpeg,jpg,png,webp,svg|max:10000',
            'video' => [
                'required',
                'url',
                'max:255',
                ValidationRule::unique('estados', 'video') -> ignore($this -> estado -> idEstadoRepublica, 'idEstadoRepublica'),
            ],
            'triptico' => 'required|mimes:pdf|max:10500',
            'guia' => 'required|mimes:pdf|max:10500',
        ];
    }

}
