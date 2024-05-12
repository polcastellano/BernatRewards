<?php

namespace Tests\Feature;

use App\Models\Recompensa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PruebasUnitarias extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function test_can_create_user()
    {
        // Crea un usuario
        $user = User::factory()->create();

        // Verifica que el usuario se haya creado en la base de datos
        $this->assertDatabaseHas('users', ['id' => $user->id,]);

    }

    //En proceso
    // public function test_can_create_recompensa()
    // {
    //     // Crea un usuario
    //     $recompensa = Recompensa::factory()->create();

    //     // Verifica que el usuario se haya creado en la base de datos
    //     $this->assertDatabaseHas('recompensas', ['id' => $recompensa->id,]);

    // }
}
