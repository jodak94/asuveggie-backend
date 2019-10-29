<?php

namespace Modules\Locales\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Local extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    protected $table = 'locales__locals';
    protected $fillable = ['nombre', 'latitud', 'longitud', 'descripcion', 'direccion', 'telefono', 'user_id', 'estado'];

    public function horarios(){
      return $this->hasMany('Modules\Locales\Entities\Horario');
    }

    public static $estados = [
      'pendiente' => 'Pendiente',
      'verificado' => 'Verificado',
      'eliminado' => 'Eliminado',
      'inactivo' => 'Inactivo'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(350)
              ->height(248)
              ->sharpen(10);
    }
}
