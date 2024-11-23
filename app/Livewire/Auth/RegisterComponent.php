<?php

namespace App\Livewire\Auth;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Rule;

class RegisterComponent extends Component
{
    #[Rule('required|string|min:3|max:50|regex: /^[\pL\s]+$/u')]
    public $nombre;

    #[Rule('required|email|unique:usuarios,email|regex:/^.+@.+$/i')]
    public $email;

    #[Rule('required|string|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/')]
    public $password;

    #[Rule('required|string|min:8|max:20|same:password|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/')]
    public $password_confirmation;

    public $terminos = false;

    public function register()
    {
        $this -> validate();

        Usuario::create([
            'nombre' => $this -> nombre,
            'email' => $this -> email,
            'password' => Hash::make($this -> password),
            'confirmado' => 1,
            'status' => 'activo',
            'idRol' => 1,
        ]);

        session() -> flash('login-success', '¡Registro exitoso! Por favor inicia sesión.');

        return $this -> redirect('login');
    }

    public function render()
    {
        return view('livewire.auth.register-component');
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede tener más de 50 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debes proporcionar una dirección de correo electrónico válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'email.regex' => 'El formato del correo electrónico no es válido.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser un texto válido.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 20 caracteres.',
            'password.same' => 'Las contraseñas deben coincidir.',
            'password.regex' => 'Al menos una letra minúscula, una letra mayúscula y un número.',

            'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
            'password_confirmation.string' => 'La confirmación de la contraseña debe ser un texto válido.',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres.',
            'password_confirmation.max' => 'La confirmación de la contraseña no puede tener más de 20 caracteres.',
            'password_confirmation.same' => 'Las contraseñas debe coincidir.',
            'password_confirmation.regex' => 'Al menos una letra minúscula, una letra mayúscula y un número.',
        ];
    }

}
