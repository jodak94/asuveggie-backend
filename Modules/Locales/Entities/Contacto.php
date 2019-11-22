<?php

namespace Modules\Locales\Entities;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contacto';
    protected $fillable = ['nombre', 'telefono', 'email', 'message', 'leido'];

}
