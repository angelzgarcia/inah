<?php

namespace App\Livewire\Forms\Zona;

use App\Models\UbicacionZona;
use App\Models\Zona;
use App\Models\ZonaImagen;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class CreateForm extends Form
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
    public $condicion = '';

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
    public $estadoRelacionado = '';

    #[Rule('required|exists:culturas,idCultura')]
    public $culturaRelacionada = '';

    #[Rule('required|array|min:2|max:4')]
    public $imagenes = [];

    public
    $openCreate = false;


    public function save()
    {
        $this->validate();

        if (count($this -> imagenes) > 0) {

            $this -> validateImagesExtension($this -> imagenes);

            $coords = getCoordinates($this -> direccion);
            if (!$coords) {
                $this -> validate();
                return 'location';
            }

            [$de_hora, $de_minutos] = explode(':', $this -> deHora);
            [$a_hora, $a_minutos] = explode(':', $this -> aHora);

            $tiempo_de_hora = "$de_hora:$de_minutos " . (int)$de_hora < 12 ? 'a.m.' : 'p.m.';
            $tiempo_a_hora = "$a_hora:$a_minutos " . (int)$a_hora < 12 ? 'a.m.' : 'p.m.';

            $horario = "De {$this -> deDia} a {$this -> aDia} de las $tiempo_de_hora a las $tiempo_a_hora";

            $zona = Zona::create([
                'nombre' => $this -> nombre,
                'significado' => $this -> significado,
                'relevancia' => $this -> relevancia ?? null,
                'acceso' => $this -> acceso,
                'condicion' => $this -> condicion,
                'horario' => $horario,
                'costoEntrada' => $this -> costoEntrada,
                'contacto' => $this -> contacto ?? null,
                'idCultura' => $this -> culturaRelacionada,
                'idEstadoRepublica' => $this -> estadoRelacionado,
            ]);

            $this -> storeImgs($this -> imagenes, $zona -> idZonaArqueologica);

            $this -> storeLocation($coords, $zona -> idZonaArqueologica);

            return true;

        } else {
            $this -> reset([
                'nombre',
                'signigicado',
                'relevancia',
                'acceso',
                'condicion',
                'horario',
                'costoEntrada',
                'contacto',
                'direccion',
            ]);

            return 'imgs_count';
        }

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function validateImagesExtension($imgs)
    {
        foreach ($imgs as $img) {
            if (!in_array($img -> extension(), ['jpg', 'png', 'jpeg', 'webp'])) {
                return 'imgs_extension';
            }
        }
    }

    public function storeImgs($imgs, $idZona)
    {
        foreach ($imgs as $img)
            ZonaImagen::create([
                'foto' => basename(time() . '-' . $img -> store('img/uploads', 'public')),
                'idZonaArqueologica' => $idZona,
            ]);
    }

    public function storeLocation($coords, $idZona)
    {
        UbicacionZona::create([
            'latitud' => $coords['lat'],
            'longitud' => $coords['lng'],
            'idZonaArqueologica' => $idZona,
        ]);
    }

}
