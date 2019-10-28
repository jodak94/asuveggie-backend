<?php

namespace Modules\Locales\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Locales\Entities\Local;
use Modules\Locales\Http\Requests\CreateLocalRequest;
use Modules\Locales\Http\Requests\UpdateLocalRequest;
use Modules\Locales\Repositories\LocalRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Auth;
use Log;
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
        return view('locales::admin.locals.create');
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

        $request['user_id'] = Auth::user()->id;
        $request['estado'] = Local::$estados['pendiente'];
        $local = $this->local->create($request->all());

        $local->addMediaFromBase64($request->logo)->toMediaCollection('logo');
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
        return view('locales::admin.locals.edit', compact('local', 'estados'));
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

        $local = $this->local->update($local, $request->all());

        if($request->editar_logo){
          $local->getMedia('logo')->first()->delete();
          $local->addMediaFromBase64($request->logo)->toMediaCollection('logo');
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
}
