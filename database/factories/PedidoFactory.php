<?php

namespace Database\Factories;

use App\Models\Recompensa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtener un usuario existente
        $user = User::inRandomOrder()->first();
               
        // Obtener una recompensa existente
        $recompensa = Recompensa::inRandomOrder()->first();
        
        return [
            'usuario_id' => $user->id,
            'recompensa_id' => $recompensa->id,
        ];
    }
}
