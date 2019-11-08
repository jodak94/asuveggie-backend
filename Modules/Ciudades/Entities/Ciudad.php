<?php

namespace Modules\Ciudades\Entities;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{

    protected $table = 'ciudades__ciudads';
    public $translatedAttributes = [];
    protected $fillable = ['nombre'];
}
