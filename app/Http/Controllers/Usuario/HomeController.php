<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home() {
        return view('usuario.home');
    }

    public function mapa_estados_index()
    {
        return view('usuario.mapa-estados');
    }

    public function mapa_zonas_index()
    {
        return view('usuario.mapa-zonas');
    }

    public function nosotros_index()
    {
        return view('usuario.nosotros');
    }

}
