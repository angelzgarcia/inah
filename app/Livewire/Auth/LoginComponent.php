<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Rule;

class LoginComponent extends Component
{
    #[Rule('required|email|exists:usuarios,email|regex:/^.+@.+$/i')]
    public $email;

    #[Rule('required|string|min:8|max:20')]
    public $password;

    public $remember = false;

    public function login()
    {
        $this -> validate();

        if (Auth::attempt(['email' => $this -> email, 'password' => $this -> password, 'idRol' => 2], $this->remember))
            return $this -> redirect('admin/dashboard');

        elseif(Auth::attempt(['email' => $this -> email, 'password' => $this -> password, 'idRol' => 1], $this->remember) )
            return $this -> redirect('perfil');

        session() -> flash('login-unsuccess', 'Credenciales no validas.');
    }

    public function render()
    {
        return view('livewire.auth.login-component');
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes proporcionar una dirección de correo electrónico válida.',
            'email.exists' => 'No encontramos una cuenta vinculada a este correo electrónico.',
            'email.regex' => 'El formato del correo electrónico no es válido.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser un texto válido.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 20 caracteres.',
        ];
    }

}
