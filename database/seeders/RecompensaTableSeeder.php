<?php

namespace Database\Seeders;

use App\Models\CategoriaRecompensa;
use App\Models\Recompensa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecompensaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recompensa = Recompensa::create([
            'nombre' => 'Silla acolchada',
            'descripcion' => 'Silla mas comoda durante un dia',
            'precio' => '500',
            'imagen' => 'foto.png',
            'nivel_desbloqueo' => '2',
        ]);

        $recompensa2 = Recompensa::create([
            'nombre' => 'Llegar tarde',
            'descripcion' => 'Permite llegar 5 min tarde a una clase',
            'precio' => '800',
            'imagen' => 'foto.png',
            'nivel_desbloqueo' => '5',
        ]);

        $r = 
        [
            ['categoria_id' => '3', 'recompensa_id' => '1'],
            ['categoria_id' => '2', 'recompensa_id' => '1'],
            ['categoria_id' => '1', 'recompensa_id' => '2']
        ];
        $recompensa->categorias()->attach($r);

        // $categoriaRecompensa1 = CategoriaRecompensa::create([
        //     'categoria_id' => '3',
        //     'recompensa_id' => '1',
        // ]);

        // $categoriaRecompensa11 = CategoriaRecompensa::create([
        //     'categoria_id' => '2',
        //     'recompensa_id' => '1',
        // ]);

        // $categoriaRecompensa2 = CategoriaRecompensa::create([
        //     'categoria_id' => '1',
        //     'recompensa_id' => '2',
        // ]);
    }
}
