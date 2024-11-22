<?php

namespace App\Livewire\Forms\Zona;

use App\Models\Cultura;
use App\Models\Estado;
use App\Models\UbicacionZona;
use App\Models\Zona;
use App\Models\ZonaImagen;
use Illuminate\Support\Facades\Storage;
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

        // $direccion = getAddress($this -> zona -> ubicacion -> latitud, $this -> zona -> ubicacion -> longitud);
        // $this -> direccion = $direccion;

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
        $this -> validate([
            'nombre' => [
                'required',
                'string',
                'min:5',
                'max:50',
                'regex:/^[\pL\s]+$/u',
                ValidationRule::unique('zonas', 'nombre')
                                -> ignore($this -> zona -> idZonaArqueologica, 'idZonaArqueologica')
            ],
            'costoEntrada' => 'required|numeric|max:1000|min:0',
            'significado' => 'required|string|max:300|min:10',
            'relevancia' => 'nullable|string|max:1600|min:200',
            'acceso' => 'required|string|max:800|min:50',
            'condicion' => 'required|string|in:abierta,no abierta',
            'contacto' => 'nullable|string|max:300|min:10',
            'deDia' => 'required|string|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'aDia' => 'required|string|in:lunes,martes,miercoles,jueves,viernes,sabado,domingo',
            'deHora' => 'required|regex:/^\d{2}:\d{2}$/',
            'aHora' => 'required|regex:/^\d{2}:\d{2}$/',
            'direccion' => 'required|string',
            'estadoRelacionado' => 'required|exists:estados,idEstadoRepublica',
            'culturaRelacionada' => 'required|exists:culturas,idCultura',
            'imgs_nuevas' => 'nullable|array|max:4|distinct|max:10000',
            'imgs_update' => 'nullable|array|max:4|distinct',
            'to_eliminate_imgs' => 'nullable|array|max:4|distinct',
        ]);

        $imgs_nuevas_count = count($this -> imgs_nuevas);
        $imgs_to_el_count = count($this -> to_eliminate_imgs);
        $imgs_update_count = count($this -> imgs_update);

        if ($imgs_nuevas_count > 0) $this -> validateImagesExtension($this -> imgs_nuevas);
        if ($imgs_to_el_count > 0) $this -> validateImagesExtension($this -> to_eliminate_imgs);
        if ($imgs_update_count > 0) $this -> validateImagesExtension($this -> imgs_update);

        if ($imgs_nuevas_count  > 0 || $imgs_to_el_count  > 0 || $imgs_update_count > 0 ) {
            if ($this -> imgs_count + $imgs_nuevas_count - $imgs_to_el_count > 4) {
                $this -> resetImagenes();
                return 'max-img';
            }

            if ($imgs_to_el_count == $imgs_nuevas_count) {
                $this -> uploadElimianteImage();
                return;
            }

            if (($imgs_to_el_count  > 1 && ($imgs_to_el_count + $imgs_nuevas_count ==  $this -> imgs_count)) || ($this -> imgs_count - $imgs_to_el_count + $imgs_nuevas_count < 2)) {
                $this -> resetImagenes();
                return 'min-img';
            }

            if
                (
                    !empty($this -> to_eliminate_imgs) &&
                    ($this -> imgs_count == $imgs_to_el_count &&
                    $this -> imgs_count == $imgs_update_count &&
                    $this -> imgs_count == $imgs_nuevas_count)
                ) { $this -> uploadElimianteImage(); return; }

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

        [$de_hora, $de_minutos] = explode(':', $this -> deHora);
        [$a_hora, $a_minutos] = explode(':', $this -> aHora);

        $de_periodo = (int)$de_hora < 12 ? 'a.m.' : 'p.m.';
        $a_periodo =  (int)$a_hora < 12 ? 'a.m.' : 'p.m.';

        $tiempo_de_hora = "$de_hora:$de_minutos $de_periodo";
        $tiempo_a_hora = "$a_hora:$a_minutos $a_periodo";

        $horario = "De {$this -> deDia} a {$this -> aDia} de las $tiempo_de_hora a las $tiempo_a_hora";

        $zonaLocation = UbicacionZona::where('idZonaArqueologica', $this -> zona -> idZonaArqueologica)
                                    -> first();

        $coords = getCoordinates($this -> direccion);
        if (!$coords) {
            $this -> validate();
            return 'location';
        }

        if ($coords['lat'] != $zonaLocation['latitud'] && $coords['lng'] != $zonaLocation['longitud']) {
            $this -> zona -> ubicacion -> latitud = $coords['lat'];
            $this -> zona -> ubicacion -> longitud = $coords['lng'];
        }

        $this -> zona -> update($this -> only([
            'nombre',
            'significado',
            'relevancia',
            'acceso',
            'condicion',
            'horario' => $horario,
            'costoEntrada',
            'contacto',
            'idCultura' => $this -> culturaRelacionada,
            'idEstadoRepublica' => $this -> estadoRelacionado,
        ]));



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

    public function validateImagesExtension($imgs)
    {
        foreach ($imgs as $img) {
            if (!in_array($img -> extension(), ['jpg', 'png', 'jpeg', 'webp'])) {
                return 'imgs_extension';
            }
        }
    }

    public function resetImagenes()
    {
        $this -> reset(['to_eliminate_imgs', 'imgs_update', 'imgs_nuevas']);
        $this -> fotoKey = rand();
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
        $zonaImagen = new ZonaImagen();
        $zonaImagen -> foto = basename(time() .'-'. $new_img -> store('img/uploads', 'public'));
        $zonaImagen -> idZonaArqueologica = $this -> zona -> idZonaArqueologica;
        $zonaImagen -> save();
    }

    public function updateImage($id, $new_img)
    {
        $img = ZonaImagen::where('idZonaFoto', $id) -> first();
        Storage::disk('public') -> delete("img/uploads/{$img -> foto}");
        $img -> foto = basename(time() . '-' . $new_img -> store('img/uploads', 'public'));
        $img -> update();
    }

    public function eliminateImage($id)
    {
        $image = ZonaImagen::where('idZonaFoto', $id) -> first();
        if ($image) {
            Storage::disk('public') -> delete("img/uploads/{$image -> foto}");
            $image -> delete();
        }
    }


}
