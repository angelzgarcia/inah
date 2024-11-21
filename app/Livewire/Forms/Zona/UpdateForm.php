<?php

namespace App\Livewire\Forms\Zona;

use App\Models\Cultura;
use App\Models\Estado;
use App\Models\Zona;
use Livewire\Attributes\Rule;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Form;

class UpdateForm extends Form
{
    use WithFileUploads;

    #[Rule('required|unique:zonas,nombre|string|max:50|min:5|regex: /^[\pL\s]+$/u')]
    public $nombre;

    #[Rule('required|numeric|max:1000|min:0')]
    public $costoEntrada;

    #[Rule('required|string|max:300|min:10')]
    public $significado;

    #[Rule('nullable|string|max:1600|min:200')]
    public $relevancia;

    #[Rule('required|string|max:800|min:50')]
    public $acceso;

    #[Rule('required|string|in:abierta,no abierta')]
    public $condicion;

    #[Rule('nullable|string|max:300|min:10')]
    public $contacto;

    #[Rule('required|string|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo')]
    public $deDia = 'lunes';

    #[Rule('required|string|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo')]
    public $aDia = 'domingo';

    #[Rule('required|regex: /^\d{2}:\d{2}$/')]
    public $deHora;

    #[Rule('required|regex: /^\d{2}:\d{2}$/')]
    public $aHora;

    #[Rule('required')]
    public $direccion;

    #[Rule('required|exists:estados,idEstadoRepublica')]
    public $estadoRelacionado;

    #[Rule('required|exists:culturas,idCultura')]
    public $culturaRelacionada;

    #[Rule('nullable|max:4|distinct|array|max:10000')]
    public $imgs_nuevas = [];

    #[Rule('nullable|max:4|distinct|array')]
    public $imgs_update = [];

    #[Rule('nullable|max:4|distinct|array')]
    public $to_eliminate_imgs = [];


    public
    $openEdit = false,
    $imgs_count,
    $fotoKey,
    $zona;

    public function edit($zonaID)
    {
        $this -> cargarEstadoCultura($zonaID);

        $horario = explode(' ', $this -> zona -> horario);
        for ($i = 0; $i < count($horario); $i++) $horario[$i];

        $this -> deDia = $horario[1];
        $this -> aDia = $horario[3];
        $this -> deHora = $horario[6];
        $this -> aHora = $horario[count($horario)-2];

        $direccion = getAddress($this -> zona -> ubicacion -> latitud, $this -> zona -> ubicacion -> longitud);
        $this -> direccion = $direccion;

        $this -> fill($this -> zona -> only([
            'nombre',
            'significado',
            'relevancia',
            'acceso',
            'condicion',
            'costoEntrada',
            'contacto',
        ]));

        $this -> openEdit = true;
    }

    public function update()
    {
        $this -> validate(
        [
                    'nombre' => [
                        'required',
                        'string',
                        'min:3',
                        'max:50',
                        'regex:/^[\pL\s]+$/u',
                        ValidationRule::unique('culturas', 'nombre')
                                        -> ignore($this->zona->idZonaArqueologica, 'idZonaArqueologica')
                    ],
                    'periodo' => 'required|max:80|min:20',
                    'significado' => 'required|max:255|min:10',
                    'descripcion' => 'required|max:1024|min:200',
                    'aportaciones' => 'required|max:1000|min:50',
                    'imgs_nuevas' => 'nullable|array|max:4|distinct',
                    // 'imgs_nuevas.*' => 'mimes:jpg,png,jpeg,webp|max:10000',
                    'imgs_update' => 'nullable|array|max:4|distinct',
                    // 'imgs_update.*' => 'mimes:jpg,png,jpeg,webp|max:10000',
                    'to_eliminate_imgs' => 'nullable|array|max:4|distinct',
                    'estadosActualesID' => 'required|array|min:1|distinct',
                    // 'estadosActualesID.*' => 'exists:estados,idEstadoRepublica',
                    'estadosUpdateID' => 'nullable|array|distinct',
                    // 'estadosUpdateID.*' => 'exists:estados,idEstadoRepublica',
                    'estadosRemovedID' => 'nullable|array|distinct',
                    // 'estadosRemovedID.*' => 'exists:estados,idEstadoRepublica',
                ]
            );
    }

    public function cargarEstadoCultura($zonaID)
    {
        $zona = Zona::find($zonaID);
        $this -> zona = $zona;

        $this -> estadoRelacionado =
            Estado::select('idEstadoRepublica')
                    -> where('idEstadoRepublica', $this -> zona -> idEstadoRepublica)
                    -> pluck('idEstadoRepublica')
                    -> first();

        $this -> culturaRelacionada =
            Cultura::select('idCultura')
                    -> where('idCultura', $this -> zona -> idCultura)
                    -> pluck('idCultura')
                    -> first();
    }


}
