<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Rol;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'google_id' => fake() -> unique() -> numerify('############'),
            'nombre' => fake() -> name(),
            'genero' => fake() -> randomElement(['Masculino', 'Femenino']),
            'foto' => fake() -> imageUrl(),
            'email' => fake() -> unique() -> safeEmail(),
            'numero' => fake() -> unique() -> e164PhoneNumber(),
            'password' => static::$password ??= Hash::make('password'),
            'token' => Str::random(10),
            'confirmado' => fake() -> randomElement([0, 1]),
            'status' => fake() -> randomElement(['activo', 'inactivo']),

            'idRol' => Rol::inRandomOrder()
                    -> first()
                    -> idRol,
        ];
    }
}
