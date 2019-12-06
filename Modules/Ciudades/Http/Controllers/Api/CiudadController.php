<?php

namespace Modules\Ciudades\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ciudades\Entities\Ciudad;
class CiudadController
{
    public function index(Request $request){
      $ciudades = Ciudad::orderBy('nombre')->select('id', 'nombre')->get();
      return response()->json(['ciudades' => $ciudades]);
    }
}
