<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Subastas',
            'Ventajas',
            'Comodidades'
        ];

        foreach ($categorias as $categoria) {
            Categoria::create(['nombre' => $categoria]);
        }
    }
}
