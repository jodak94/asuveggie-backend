<?php

namespace Modules\Locales\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Publicacion extends Model implements HasMediaConversions
{
    use HasMediaTrait;
    
    protected $table = 'publicaciones';
    protected $fillable = ['titulo', 'texto', 'global', 'estado', 'local_id'];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(350)
              ->height(350)
              ->sharpen(10);
    }
}
