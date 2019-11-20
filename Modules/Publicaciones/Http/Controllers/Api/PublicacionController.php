<?php

namespace Modules\Publicaciones\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Locales\Entities\Local;
use Modules\Locales\Entities\Horario;
use Modules\Publicaciones\Entities\Publicacion;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Auth;
use Log;
use DB;
use Spatie\MediaLibrary\Media;
class PublicacionController
{
    public function index(Request $request){
      $publicaciones = Publicacion::where('estado', 'publicado')->with(['local' => function($q){
        $q->select('id', 'latitud', 'longitud', 'nombre', 'ciudad_id')->with(['ciudad' => function($q_c){
          $q_c->select('id', 'nombre');
        }]);
      }])->get();
      foreach ($publicaciones as $pub) {
        $pub->img = $pub->getMedia('img')->first()->getFullUrl();
      }
      return response()->json(['error' => false, 'publicaciones' => $publicaciones]);
    }
}
