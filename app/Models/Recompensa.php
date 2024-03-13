<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Recompensa extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'nivel_desbloqueo',
    ];

    public function categorias(){

        return $this->belongsToMany(Categoria::class, 'categorias_recompensas');
    }

    public function pedidos(){

        return $this->belongsToMany(Pedido::class, 'pedidos_recompensas');
    }

    public function registerMediaCollections(): void{
        $this->addMediaCollection('images/recompensas')
        ->useFallbackUrl('/images/placeholder.jpg')
        ->useFallbackPath(public_path('/images/placeholder.jpg'));
    }

    public function registerMediaConversions(Media $media = null): void
    {
        if (env('RESIZE_IMAGE') === true) {

            $this->addMediaConversion('resized-image')
                ->width(env('IMAGE_WIDTH', 300))
                ->height(env('IMAGE_HEIGHT', 300));
        }
    }

}


