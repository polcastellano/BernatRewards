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
        $this->call(NivelTableSeeder::class); //Poner delante de ADMINUSER SEEDER

        $this->call(CreateAdminUserSeeder::class);
        $this->call(CategoriaTableSeeder::class);
        $this->call(RecompensaTableSeeder::class);
        $this->call(PedidoTableSeeder::class);



        // $this->call(RoleSeeder::class);
        // \App\Models\User::factory(10)->create();


        //Llamada a factory de usuario
        \App\Models\User::factory()->create();
    }
}
