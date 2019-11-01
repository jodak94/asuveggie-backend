<?php

namespace Modules\Publicidades\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Carbon\Carbon;
class Publicidad extends Model implements HasMediaConversions
{
    use HasMediaTrait;
    protected $table = 'publicidades__publicidads';
    protected $fillable = ['activo', 'ubicacion'];

    public static $ubicaciones = [
      'inicio' => 'Inicio',
      'local' => 'Local'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(350)
              ->height(350)
              ->sharpen(10);
    }
}
