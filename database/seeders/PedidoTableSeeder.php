<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedido = Pedido::create([
            'cantidad' => '1',
            'precio_total' => '1500',
            'usuario_id' => '1',
            'fecha' => '2024-02-28 15:34:39',
        ]);   
        
        $p = 
        [
            ['pedido_id' => '1', 'recompensa_id' => '1'],
        ];
        $pedido->recompensas()->attach($p);
    }
    
}
