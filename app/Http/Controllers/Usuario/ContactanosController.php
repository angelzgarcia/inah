<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Mail\ContactanosMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller
{

    public function index()
    {
        return view('usuario.contactanos.index');
    }

    public function store(Request $request)
    {
        $request -> validate([
            'nombre' => 'required|string|max:40|min:5',
            'correo' => 'required|email',
            'mensaje' => 'required|string|max:300|min:50'
        ]);

        Mail::to('c153bangelrodriguezg@gmail.com')
            -> send(new ContactanosMailable($request->all()));

        // session() -> flash('info', 'Mensaje enviado con éxito');
        return redirect() -> route('user.contactanos.index') -> with('info', 'Mensaje enviado con éxito');
    }

}
