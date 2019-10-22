<?php

namespace Modules\Locales\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{

    protected $table = 'locales__locals';
    protected $fillable = ['nombre', 'latitud', 'longitud', 'descripcion', 'direccion', 'telefono'];
}
