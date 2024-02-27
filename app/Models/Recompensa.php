<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recompensa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'nivel_desbloqueo',
    ];

    public function categorias(){
        return $this->belongsToMany(Categoria::class, 'id');
    }

}


