<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{

    public function index() {
        $zonas = Zona::orderBy('nombre', 'asc') -> paginate();

        return view('usuario.zonas.index', compact('zonas'));
    }

    public function show(Zona $zona)
    {
        if (!$zona) {
            return redirect() -> route('user.zonas.index');
        }

        return view('usuario.zonas.show', compact('zona'));
    }

}
