<?php

namespace Database\Factories;

use App\Models\Resenia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReseniaImagen>
 */
class ReseniaImagenFactory extends Factory
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

            'idResenia' => Resenia::inRandomOrder()
                        -> first()
                        -> idResenia,
        ];
    }
    
}
