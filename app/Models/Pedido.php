<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cantidad',
        'precio_total',
        'usuario_id',
        'fecha',
    ];

    public function recompensas(){

        return $this->belongsToMany(Recompensa::class, 'pedidos_recompensas');
    }
}
