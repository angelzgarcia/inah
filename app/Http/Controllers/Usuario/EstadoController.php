<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{

    public function index() {
        return view('usuario.estados.index');
    }

    public function show(Estado $estado)
    {
        if (!$estado) {
            return redirect() -> route('usuario.estados.index');
        }

        return view('usuario.estados.show', compact('estado'));
    }

}
