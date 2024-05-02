<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'usuario_id',
        'recompensa_id',
    ];

    public function recompensa(){

        return $this->belongsTo(Recompensa::class, 'recompensa_id');
    }
}
