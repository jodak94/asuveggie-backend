<?php

namespace Modules\Locales\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Horario extends Model
{
    protected $table = 'horarios';
    protected $fillable = ['dia_inicio', 'dia_fin', 'hora_inicio', 'hora_fin', 'local_id'];

}
