<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Cultura;
use Illuminate\Http\Request;

class CulturaController extends Controller
{

    public function index() {
        $culturas = Cultura::orderBy('nombre', 'asc') -> paginate();

        return view('usuario.culturas.index', compact('culturas'));
    }


    public function show(Cultura $cultura)
    {
        if (!$cultura) {
            return redirect() -> route('culturas.index');
        }

        return view('usuario.culturas.show', compact('cultura'));
    }

}
