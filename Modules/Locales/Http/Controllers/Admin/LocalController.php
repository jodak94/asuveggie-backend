<?php

namespace Modules\Locales\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Locales\Entities\Local;
use Modules\Locales\Entities\Horario;
use Modules\Locales\Http\Requests\CreateLocalRequest;
use Modules\Locales\Http\Requests\UpdateLocalRequest;
use Modules\Locales\Repositories\LocalRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Auth;
use Log;
use DB;
use Spatie\MediaLibrary\Media;
class LocalController extends AdminBaseController
{
    /**
     * @var LocalRepository
     */
    private $local;
    private $f_max = 6;
    public function __construct(LocalRepository $local)
    {
        parent::__construct();

        $this->local = $local;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $locals = $this->local->all();
        $estados = Local::$estados;
        return view('locales::admin.locals.index', compact('locals', 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        return view('locales::admin.locals.create', compact('dias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLocalRequest $request
     * @return Response
     */
    public function store(CreateLocalRequest $request)
    {
        if((!isset($request->latitud) || !isset($request->longitud)))
          return redirect()->back()->withInput()->withError('Debe seleccionar una ubicación');

        if((!isset($request->ciudad_id)))
          return redirect()->back()->withInput()->withError('Debe seleccionar una ciudad');
        try{
          DB::beginTransaction();
          $request['user_id'] = Auth::user()->id;
          $request['estado'] = Local::$estados['pendiente'];
          $local = $this->local->create($request->all());

          foreach ($request->dia_inicio as $key => $value) {
            $horario = new Horario();
            $horario->dia_inicio = $value;
            $horario->dia_fin = $request->dia_fin[$key];
            $horario->hora_inicio = $request->hora_inicio[$key];
            $horario->hora_fin = $request->hora_fin[$key];
            $horario->local_id = $local->id;
            $horario->save();
          }

          $local->addMediaFromBase64($request->logo)->toMediaCollection('logo');

          DB::commit();
        }catch(\Exception $e){
          return redirect()->back()->withInput()->withError('Ocurrió un error inesperado');
        }

        return redirect()->route('dashboard.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('locales::locals.title.locals')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Local $local
     * @return Response
     */
    public function edit(Local $local, Request $request)
    {
        //Obtener thumb
        //dd($local->getMedia('galeria')->first()->getUrl('thumb'));
        $user = Auth::user();
        if($local->user_id != $user->id && !$user->hasRoleSlug('admin'))
          return redirect()->route('dashboard.index')->withError('No tiene permiso para realizar la acción');

        $estados = Local::$estados;
        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        return view('locales::admin.locals.edit', compact('local', 'estados', 'dias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Local $local
     * @param  UpdateLocalRequest $request
     * @return Response
     */
    public function update(Local $local, UpdateLocalRequest $request)
    {
        $user = Auth::user();
        if($local->user_id != $user->id && !$user->hasRoleSlug('admin'))
          return redirect()->route('dashboard.index')->withError('No tiene permiso para realizar la acción');

        try{
          DB::beginTransaction();
          $local = $this->local->update($local, $request->all());

          foreach ($local->horarios as $h) {
            $h->delete();
          }
          if(isset($request->dia_inicio) && count($request->dia_inicio))
            foreach ($request->dia_inicio as $key => $value) {
              $horario = new Horario();
              $horario->dia_inicio = $value;
              $horario->dia_fin = $request->dia_fin[$key];
              $horario->hora_inicio = $request->hora_inicio[$key];
              $horario->hora_fin = $request->hora_fin[$key];
              $horario->local_id = $local->id;
              $horario->save();
            }

          if($request->editar_logo){
            $local->getMedia('logo')->first()->delete();
            $local->addMediaFromBase64($request->logo)->toMediaCollection('logo');
          }

        DB::commit();
        }catch(\Exception $e){
          return redirect()->back()->withInput()->withError('Ocurrió un error inesperado');
        }

        return redirect()->route('dashboard.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('locales::locals.title.locals')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Local $local
     * @return Response
     */
    public function destroy(Local $local)
    {
        $user = Auth::user();
        if($local->user_id != $user->id && !$user->hasRoleSlug('admin'))
          return redirect()->route('dashboard.index')->withError('No tiene permiso para realizar la acción');

        if($user->hasRoleSlug('admin'))
          $this->local->destroy($local);
        else{
          $local->estado = 'eliminado';
          $local->save();
        }

        return redirect()->route('dashboard.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('locales::locals.title.locals')]));
    }

    public function galeria(Local $local){
      // dd($galeria)
      $user = Auth::user();
      if($local->user_id != $user->id && !$user->hasRoleSlug('admin'))
        return redirect()->route('dashboard.index')->withError('No tiene permiso para realizar la acción');

      $f_max = $this->f_max;
      return view('locales::admin.locals.galeria', compact('local', 'f_max'));
    }

    public function store_galeria(Local $local, Request $request){
      $user = Auth::user();
      if($local->user_id != $user->id && !$user->hasRoleSlug('admin'))
        return redirect()->route('dashboard.index')->withError('No tiene permiso para realizar la acción');

      if(count($local->getMedia('galeria')) >= $this->f_max)
        return redirect()->back()->withError('Excedió el límite de imágenes');

      $local->addMedia($request->file('file'))->toMediaCollection('galeria');

      return response('ok', 200);
    }

    public function store_galeria_ajax(Local $local, Request $request){
      $user = Auth::user();
      if($local->user_id != $user->id && !$user->hasRoleSlug('admin'))
        return response()->json(['error' => true, 'message' => 'No tiene permiso para realizar la acción']);

      if(count($local->getMedia('galeria')) >= $this->f_max)
        return response()->json(['error' => true, 'message' => 'Excedió el límite de imágenes']);

      $local->addMediaFromBase64($request->file)->toMediaCollection('galeria');
      $file_id = $local->getMedia('galeria')->last();
      $delete_route = route('admin.locales.local.delete_file', [$local->id, $file_id]);

      return response()->json(['error' => false, 'message' => 'La galería se actualizo correctamente', 'delete_route' => $delete_route]);
    }

    public function delete_file(Local $local, Media $file){
      $user = Auth::user();
      if($local->user_id != $user->id && !$user->hasRoleSlug('admin'))
        return redirect()->route('dashboard.index')->withError('No tiene permiso para realizar la acción');

      $ids = $local->getMedia('galeria')->pluck('id')->toArray();
      if(!in_array($file->id, $ids))
        return redirect()->route('dashboard.index')->withError('No tiene permiso para realizar la acción');

      $file->delete();
      return redirect()->route('admin.locales.local.galeria', $local->id)->withSuccess('Operación realizada éxitosamente.');
    }

    public function crear_publicacion(){
      $user = Auth::user();
      if($user->hasRoleSlug('admin'))
        $locales = ['Todos'];
      else
        $locales = $user->locales()->where('estado', 'verificado')->pluck('nombre', 'id')->toArray();

      return view('locales::admin.locals.crear_publicacion', compact('locales'));
    }
}
