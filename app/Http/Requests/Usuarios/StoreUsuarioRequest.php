<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:80|min:10',
            'genero' => 'required|string|max:10',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:10000',
            'email' => 'required|email|unique:usuarios,email|regex:/^.+@.+$/i',
            'numero' => 'required|string|unique:usuarios,numero|max:15|min:10',
            // 'idRol' => 'required|exists:roles,idRol',
        ];
    }

    public function messages() {
        return [
        ];
    }

    public function attributes() {
        return [
        ];
    }

}
