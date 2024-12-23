<?php

namespace Database\Factories;

use App\Models\Cultura;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CulturaImagen>
 */
class CulturaImagenFactory extends Factory
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

            'idCultura' => Cultura::inRandomOrder()
                        -> first()
                        -> idCultura,
        ];
    }

}
