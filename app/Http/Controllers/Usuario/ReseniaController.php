<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Resenia;
use Illuminate\Http\Request;

class ReseniaController extends Controller
{

    public function index()
    {
        return view('usuario.foro.index');
    }

    public function show(Resenia $resenia)
    {
        if (!$resenia) {
            return redirect() -> route('usuario.foro.index');
        }

        return view('usuario.foro.show', compact('resenia'));
    }


}
