<?php

namespace Database\Factories;

use App\Models\Usuario;
use App\Models\Zona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resenia>
 */
class ReseniaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mensaje' => fake() -> paragraphs(3, true),
            'puntuacion' => fake() -> randomNumber(1, true),

            'idUsuario' => Usuario::inRandomOrder()
                        -> first()
                        -> idUsuario,
            'idZonaArqueologica' => Zona::inRandomOrder()
                                -> first()
                                -> idZonaArqueologica,

        ];
    }
}
