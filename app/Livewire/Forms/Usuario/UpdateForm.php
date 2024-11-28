<?php

namespace App\Livewire\Forms\Usuario;

use Livewire\Form;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use App\Models\Usuario;

class UpdateForm extends Form
{
    public
    $openEdit = false,
    $usuario,
    $enumValues,
    $statusCuenta = '';

    public function edit($idUsuario)
    {
        $this -> usuario = Usuario::find($idUsuario);

        $enumValues = DB::select('SHOW COLUMNS FROM usuarios LIKE "status"');
        $enumValues = $enumValues[0] -> Type;
        preg_match_all("/'(.*?)'/", $enumValues, $matches);

        $this -> enumValues = $matches[1];

        $this -> statusCuenta = $this -> usuario -> status;

        $this -> openEdit = true;
    }

    public function update()
    {
        $this -> usuario -> update([
            'status' => $this -> statusCuenta,
        ]);

        $this -> reset();

        return true;
    }

}
