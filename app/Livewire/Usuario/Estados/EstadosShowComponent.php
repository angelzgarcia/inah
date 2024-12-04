<?php

namespace App\Livewire\Usuario\Estados;

use App\Models\Estado;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EstadosShowComponent extends Component
{
    public
    $idEstado,
    $clima;

    public function mount($idEstado)
    {
        $this -> idEstado = $idEstado;
    }

    public function render()
    {
        $estado = Estado::find($this -> idEstado);

        $this -> obtenerClima();
        $clima = $this -> clima;

        return view('livewire.usuario.estados.estados-show-component', compact('estado', 'clima'));
    }

    public function obtenerClima()
    {
        $estado = Estado::find($this -> idEstado);

        $apiKey = env('OPENWEATHER_API_KEY');
        $lat = $estado -> ubicacion -> latitud;
        $lon = $estado -> ubicacion -> longitud;

        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units=metric&lang=es&appid={$apiKey}";

        $response = Http::get($url);

        $this -> clima = ($response->successful()) ? $response->json() : ['error' => 'No se pudo obtener el clima'];
    }

    public function mostrarCulturas()
    {
        $estado = Estado::find($this -> idEstado);

        $slug = $estado -> slug;

        return $this -> redirect(route('culturas-estados', compact('slug')), navigate:true);
    }

    public function mostrarZonas()
    {
        $estado = Estado::find($this -> idEstado);

        $slug = $estado -> slug;

        return $this -> redirect(route('zonas-estados', compact('slug')), navigate:true);
    }

}
