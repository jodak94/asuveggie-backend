<?php

namespace Modules\Locales\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Locales\Entities\Local;
use Modules\Locales\Entities\Horario;
use Modules\Locales\Entities\Contacto;
use Modules\Locales\Http\Requests\CreateLocalRequest;
use Modules\Locales\Http\Requests\UpdateLocalRequest;
use Modules\Locales\Repositories\LocalRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Auth;
use Log;
use DB;
use Spatie\MediaLibrary\Media;
class LocalController
{

    private $columns = [
      'l.nombre',
      'l.latitud',
      'l.longitud',
      'l.descripcion',
      'l.direccion',
      'l.telefono',
      'l.created_at',
      'l.updated_at'
    ];

    public function index(Request $request){
      Log::info($this->columns[$request->column]);
      $query = "SELECT l.id, l.nombre, l.latitud, l.longitud, c.nombre AS nombre_ciudad, l.direccion, l.telefono, CONCAT('".env('APP_URL')."', '/storage/', m.id, '/', m.file_name) as logo
                FROM asuveggie.locales__locals l JOIN ciudades__ciudads c ON l.ciudad_id = c.id
                JOIN media m ON m.model_id = l.id WHERE m.collection_name = 'logo' AND l.estado = 'verificado'
                ORDER BY ".$this->columns[$request->column]." ".$request->dir." LIMIT ".$request->take." OFFSET ".$request->skip."";

      $locales = DB::select($query);
      return response()->json(['error' => false, 'locales' => $locales]);
    }

    public function detail(Request $request){
      $local = Local::find($request->local_id);
      if(!isset($local))
        return response()->json(['error' => true]);
      //Galeria
      $galeria = $local->getMedia('galeria');
      $array = [];
      foreach ($galeria as $file) {
        array_push($array, $file->getFullUrl());
      }
      shuffle($array);
      $local->galeria = $galeria;

      $local->nombre_ciudad = $local->ciudad->nombre;
      //Horarios
      $query = "SELECT IF(dia_inicio = dia_fin, dia_fin, LOWER(CONCAT(dia_inicio, ' a ', dia_fin))) AS dia, hora_inicio, hora_fin
                FROM asuveggie.horarios WHERE local_id = ". $request->local_id;
      $local->horarios = DB::select($query);
      return response()->json(['error' => false, 'local' => $local]);
    }

    public function contacto(Request $request){
      $request->nombre = 'Jose';
      $request->telefono = '0972195087';
      $request->message = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';
      return response()->json(400);
      try{
        DB::beginTransaction();
        $contacto = new Contacto();
        $contacto->nombre = $request->nombre;
        if(isset($request->telefono))
          $contacto->telefono = $request->telefono;
        if(isset($request->email))
          $contacto->email = $request->email;
        $contacto->message = $request->message;
        $contacto->leido = false;
        $contacto->save();
        // DB::commit();
        return response()->json(200);
      }catch(\Exception $e){
        Log::info($e);
        return response()->json(400);
      }
    }
}
