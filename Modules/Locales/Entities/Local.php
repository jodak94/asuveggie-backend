<?php

namespace Modules\Locales\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Local extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'locales__locals';
    protected $fillable = ['nombre', 'latitud', 'longitud', 'descripcion', 'direccion', 'telefono', 'user_id', 'estado'];


    public static $estados = [
      'pendiente' => 'Pendiente',
      'verificado' => 'Verificado',
      'eliminado' => 'Eliminado',
      'inactivo' => 'Inactivo'
    ];
}
