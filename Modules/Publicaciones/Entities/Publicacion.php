<?php

namespace Modules\Publicaciones\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Carbon\Carbon;
class Publicacion extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    protected $table = 'publicaciones__publicacions';
    protected $fillable = ['titulo', 'texto', 'global', 'estado', 'local_id'];
    protected $appends = ['created_at_format', 'local_format'];

    public static $estados = [
      'Publicado' => 'Publicado',
      'Rechazado' => 'Rechazado'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(350)
              ->height(350)
              ->sharpen(10);
    }

    public function local(){
      return $this->belongsTo('Modules\Locales\Entities\Local');
    }

    public function getCreatedAtFormatAttribute(){
      $date = Carbon::parse($this->created_at);
      return $date->format('d/m/Y');
    }

    public function getLocalFormatAttribute(){
      return $this->local->nombre;
    }
}
