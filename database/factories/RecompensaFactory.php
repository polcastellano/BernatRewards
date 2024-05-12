<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recompensa>
 */
class RecompensaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Obtener un usuario existente
        $user = User::inRandomOrder()->first();

        return [
            'nombre' => "Recompensa " . $this->faker->unique()->numberBetween(1, 99999),
            'descripcion' => "descripcion automatica",
            'precio' => fake()->numberBetween(0, 1000),
            'nivel_desbloqueo' => fake()->numberBetween(0, 100),
            'usuario_id' => $user->id,
        ];
    }
}
