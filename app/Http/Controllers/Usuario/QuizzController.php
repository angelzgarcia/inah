<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizzController extends Controller
{

    public function index()
    {
        return view('usuario.quizz.index');
    }

}
