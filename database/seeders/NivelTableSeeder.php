<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NivelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nivel0 = Nivel::create([
            'numero' => '0',
            'experiencia' => '0',
        ]);

        $nivel1 = Nivel::create([
            'numero' => '1',
            'experiencia' => '1000',
        ]);

        $nivel2 = Nivel::create([
            'numero' => '2',
            'experiencia' => '2000',
        ]);

        $nivel3 = Nivel::create([
            'numero' => '3',
            'experiencia' => '3000',
        ]);

        $nivel4 = Nivel::create([
            'numero' => '4',
            'experiencia' => '4000',
        ]);

        $nivel5 = Nivel::create([
            'numero' => '5',
            'experiencia' => '5000',
        ]);



        
    }
}
