<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Zona;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ZonaImagen>
 */
class ZonaImagenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'foto' => fake() -> imageUrl(),

            'idZonaArqueologica' => Zona::inRandomOrder()
                                -> first()
                                -> idZonaArqueologica,
        ];
    }
}
