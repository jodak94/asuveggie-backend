<?php

namespace Modules\Locales\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Log;
class Local extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    protected $table = 'locales__locals';
    protected $fillable = ['nombre', 'latitud', 'longitud', 'descripcion', 'direccion', 'telefono', 'user_id', 'estado', 'destacado', 'ciudad_id'];
    protected $appends = ['logo', 'nombre_ciudad', 'galeria'];

    public function horarios(){
      return $this->hasMany('Modules\Locales\Entities\Horario');
    }

    public function publicaciones(){
      return $this->hasMany('Modules\Locales\Entities\Publicacion');
    }

    public function ciudad(){
      return $this->belongsTo('Modules\Ciudades\Entities\Ciudad');
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

    public function getLogoAttribute(){
      $media = $this->getMedia('logo')->first();
      if(isset($media))
        return $media->getFullUrl();
      else
        return '';
    }

    public function getNombreCiudadAttribute(){
      return $this->ciudad()->first()->nombre;
    }

    public function getGaleriaAttribute(){
      $galeria = $this->getMedia('galeria');
      $array = [];
      foreach ($galeria as $file) {
        array_push($array, $file->getFullUrl());
      }

      return $array;
    }
}
