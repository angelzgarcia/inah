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

            $de_periodo = (int)$de_hora < 12 ? 'a.m.' : 'p.m.';
            $a_periodo =  (int)$a_hora < 12 ? 'a.m.' : 'p.m.';

            $tiempo_de_hora = "$de_hora:$de_minutos $de_periodo";
            $tiempo_a_hora = "$a_hora:$a_minutos $a_periodo";

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

            $this -> reset();

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

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la zona es obligatorio.',
            'nombre.unique' => 'El nombre de la zona ya está en uso.',
            'nombre.string' => 'El nombre de la zona debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la zona no puede superar los 50 caracteres.',
            'nombre.min' => 'El nombre de la zona debe tener al menos 5 caracteres.',
            'nombre.regex' => 'El nombre de la zona solo puede contener letras y espacios.',

            'costoEntrada.required' => 'El costo de entrada es obligatorio.',
            'costoEntrada.numeric' => 'Ingresa solo valores numéricos.',
            'costoEntrada.max' => 'El costo de entrada no puede ser mayor a $1000 MXN.',
            'costoEntrada.min' => 'El costo de entrada no puede ser menor a $0 MXN.',

            'significado.required' => 'El significado es obligatorio.',
            'significado.string' => 'El significado debe ser una cadena de texto.',
            'significado.max' => 'El significado no puede superar los 300 caracteres.',
            'significado.min' => 'El significado debe tener al menos 10 caracteres.',

            'relevancia.string' => 'La relevancia debe ser una cadena de texto.',
            'relevancia.max' => 'La relevancia no puede superar los 1600 caracteres.',
            'relevancia.min' => 'La relevancia debe tener al menos 200 caracteres.',

            'acceso.required' => 'El acceso es obligatorio.',
            'acceso.string' => 'El acceso debe ser una cadena de texto.',
            'acceso.max' => 'El acceso no puede superar los 800 caracteres.',
            'acceso.min' => 'El acceso debe tener al menos 50 caracteres.',

            'condicion.required' => 'La condición es obligatoria.',
            'condicion.string' => 'La condición debe ser una cadena de texto.',
            'condicion.in' => 'La condición debe ser "abierta" o "no abierta".',

            'contacto.string' => 'El contacto debe ser una cadena de texto.',
            'contacto.max' => 'El contacto no puede superar los 300 caracteres.',
            'contacto.min' => 'El contacto debe tener al menos 10 caracteres.',

            'deDia.required' => 'El día de inicio es obligatorio.',
            'deDia.string' => 'El día de inicio debe ser una cadena de texto.',
            'deDia.in' => 'El día de inicio debe ser un día de la semana.',

            'aDia.required' => 'El día de fin es obligatorio.',
            'aDia.string' => 'El día de fin debe ser una cadena de texto.',
            'aDia.in' => 'El día de fin debe ser un día de la semana.',

            'deHora.required' => 'La hora de inicio es obligatoria.',
            'deHora.regex' => 'La hora de inicio debe tener el formato HH:mm.',

            'aHora.required' => 'La hora de fin es obligatoria.',
            'aHora.regex' => 'La hora de fin debe tener el formato HH:mm.',

            'direccion.required' => 'La dirección es obligatoria.',

            'estadoRelacionado.required' => 'El estado relacionado es obligatorio.',
            'estadoRelacionado.exists' => 'El estado relacionado seleccionado no es válido.',

            'culturaRelacionada.required' => 'La cultura relacionada es obligatoria.',
            'culturaRelacionada.exists' => 'La cultura relacionada seleccionada no es válida.',

            'imagenes.required' => 'Debe proporcionar al menos dos imágenes.',
            'imagenes.array' => 'Las imágenes deben ser enviadas como un arreglo.',
            'imagenes.min' => 'Debe proporcionar al menos dos imágenes.',
            'imagenes.max' => 'No puedes sobrepasar más de cuatro imágenes.',
        ];
    }


}
