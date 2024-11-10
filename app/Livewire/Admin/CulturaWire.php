<?php

namespace App\Livewire\Admin;

use App\Models\Cultura;
use App\Models\CulturaImagen;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class CulturaWire extends Component
{
    use WithFileUploads, WithPagination;

    public $openCreate = false, $openEdit = false, $openShow = false, $cultura, $nombre, $periodo, $significado, $descripcion, $aportaciones, $fotos = [], $fotoKey;
    public $culturaEdit = [
        'nombre' => '',
        'periodo' => '',
        'significado' => '',
        'descripcion' => '',
        'aportaciones' => '',
        'fotos' => [],
    ];

    // renderizar la vista
    public function render()
    {
        $culturas = Cultura::with('fotos')
                            -> orderBy('idCultura', 'desc')
                            -> paginate(5, pageName: 'pageCulturas');
        return view('livewire.admin.cultura-wire', compact('culturas'));
    }

    // crear
    public function save()
    {
        if ($this -> fotos) {
            $cultura = Cultura::create(
        $this -> only(
        'nombre',
                    'periodo',
                    'significado',
                    'descripcion',
                    'aportaciones',
                )
            );
            $this -> storeImg($this -> fotos, $cultura);
        }

        $this -> reset();
        $this -> fotoKey = rand();
    }

    // mostrar / ver detalles
    public function show($idCultura)
    {
        $this -> openShow = true;
        $this -> cultura = Cultura::with('fotos') -> where('idCultura', $idCultura) -> first();
    }

    // editar
    public function edit(Cultura $cultura)
    {
        $this -> openEdit = true;
        $this -> cultura = $cultura;

        foreach ($this -> culturaEdit as $clave => $valor) {
            $this -> culturaEdit[$clave] = $cultura[$clave];
        }
    }

    // actualizar
    public function update()
    {
        $this->cultura->update($this->culturaEdit);
        $this -> reset(['cultura', 'openEdit', 'culturaEdit']);
    }

    // eliminar
    public function destroy(Cultura $cultura)
    {
        $cultura -> delete();
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

}
