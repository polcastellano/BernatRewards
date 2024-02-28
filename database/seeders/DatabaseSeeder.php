<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CategoriaTableSeeder::class);
        $this->call(RecompensaTableSeeder::class);
        $this->call(NivelTableSeeder::class);
        $this->call(PedidoTableSeeder::class);



        // $this->call(RoleSeeder::class);
        // \App\Models\User::factory(10)->create();


        //ESTA BIEN REPETIR CODIGO DE EL FACTORY?
        \App\Models\User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'experience' => fake()->numberBetween(0, 5000),
        ]);
    }
}
