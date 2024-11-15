<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{

    public function index() {
        $estados = Estado::orderBy('nombre', 'asc') -> paginate(8, pageName: 'pageEstados');

        return view('usuario.estados.index', compact('estados'));
    }

    public function show(Estado $estado)
    {
        if (!$estado) {
            return redirect() -> route('usuario.estados.index');
        }

        return view('usuario.estados.show', compact('estado'));
    }

}
