<?php

namespace App\Livewire\Forms\Usuario;

use App\Mail\VerificarAdminMailable;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Form;

class CreateForm extends Form
{
    use WithFileUploads;

    #[Rule('required|string|max:50|min:3|regex: /^[\pL\s]+$/u')]
    public $nombre;

    #[Rule('required|email|unique:usuarios,email|regex:/^.+@.+$/i')]
    public $email;

    #[Rule('required|string|unique:usuarios,numero|max:12|min:12')]
    public $numero;

    #[Rule('required|string|max:10|min:8')]
    public $genero;

    public
    $openCreate = false,
    $openCulturasCheck = false;

    public function save()
    {
        $this -> validate();

        $avatarsM = [
            0 => 'avatar-m1.jpg',
            1 => 'avatar-m2.jpg',
            2 => 'avatar-m3.jpg',
            3 => 'avatar-m4.jpg',
            4 => 'avatar-m5.jpg',
        ];

        $avatarsW = [
            0 => 'avatar-w1.jpg',
            1 => 'avatar-w2.jpg',
            2 => 'avatar-w3.jpg',
            3 => 'avatar-w4.jpg',
            4 => 'avatar-w5.jpg',
            5 => 'avatar-w6.jpg',
        ];

        $password = hashPassword(Str::password(20, true, true, false, false));
        $token = bin2hex(random_bytes(4));

        $user = Usuario::create([
            'nombre' => $this -> nombre,
            'email' => $this -> email,
            'numero' => $this -> numero,
            'genero' => $this -> genero,
            'token' => $token,
            'password' => $password,
            'foto' => $this -> genero == 'femenino'
                ? $avatarsW[rand(0, count($avatarsW) - 1)]
                : $avatarsM[rand(0, count($avatarsM) -1)],
            'idRol' => 2,
        ]);

        $mail = Mail::to($this -> email)
            -> send(new VerificarAdminMailable($password, $token, $this -> nombre, $this -> genero == 'femenino' ? 'Bienvenida' : 'Bienvenido'));

        $this -> reset();

        if ($user && $mail) return true; else return false;
    }

    public function messages()
    {
        return [
            // Nombre
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 50 caracteres.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            // Email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes proporcionar una dirección de correo válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'email.regex' => 'El correo electrónico debe tener un formato válido.',

            // Número
            'numero.required' => 'El número es obligatorio.',
            'numero.string' => 'El número debe ser una cadena de texto.',
            'numero.unique' => 'El número ya está registrado.',
            'numero.max' => 'El número no puede tener más de 12 dígitos.',
            'numero.min' => 'El número debe tener al menos 12 dígitos.',

            // Género
            'genero.required' => 'El género es obligatorio.',
            'genero.string' => 'El género debe ser una cadena de texto.',
            'genero.max' => 'El género no puede tener más de 10 caracteres.',
            'genero.min' => 'El género debe tener al menos 8 caracteres.',
        ];
    }

}
