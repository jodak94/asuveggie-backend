<?php

namespace Modules\Publicaciones\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Publicaciones\Entities\Publicacion;
use Modules\Publicaciones\Http\Requests\CreatePublicacionRequest;
use Modules\Publicaciones\Http\Requests\UpdatePublicacionRequest;
use Modules\Publicaciones\Repositories\PublicacionRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Auth;
use Log;
use DB;
use Spatie\MediaLibrary\Media;
use Modules\Locales\Entities\Local;
use Yajra\DataTables\Facades\DataTables;
class PublicacionController extends AdminBaseController
{
    /**
     * @var PublicacionRepository
     */
    private $publicacion;

    public function __construct(PublicacionRepository $publicacion)
    {
        parent::__construct();

        $this->publicacion = $publicacion;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$publicacions = $this->publicacion->all();

        return view('publicaciones::admin.publicacions.index', compact(''));
    }

    public function index_ajax(Request $re){
      $query = $this->query_index_ajax($re);
      $object = Datatables::of($query)
          ->addColumn('acciones', function( $pub ){
            $edit_route = route('admin.publicaciones.publicacion.edit', $pub->id);
            $delete_route = route('admin.publicaciones.publicacion.destroy', $pub->id);
            $html = '
              <div class="btn-group">
                <a href="'.$edit_route.'" class="btn btn-default btn-flat" title="Editar">
                  <i class="fa fa-pencil"></i>
                </a>
                <button class="btn btn-danger btn-flat" title="Eliminar" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="'.$delete_route.'">
                  <i class="fa fa-trash"></i>
                </button>
              </div>';
            return $html;
          })
          ->rawColumns(['acciones'])
          ->make(true);
      $data = $object->getData(true);
      return response()->json( $data );
    }

    public function query_index_ajax($re){
       $query = Publicacion::select();
       $user = Auth::user();
       if(!$user->hasRoleSlug('admin')){
         $query->whereIn('local_id', $user->locales->pluck('id')->toArray());
         $query->where('estado', 'publicado');
       }

       if(isset($re->local) && trim($re->local) != '')
         $query->whereHas('local', function($q) use ($re){
           $q->where('nombre', 'like',  '%' . $re->local . '%');
       });

      if (isset($re->fecha_desde) && trim($re->fecha_desde) != '')
         $query->whereDate('created_at', '>=', $this->fechaFormat($re->fecha_desde) );

      if (isset($re->fecha_hasta) && trim($re->fecha_hasta) != '')
         $query->whereDate('created_at', '<=', $this->fechaFormat($re->fecha_hasta) );

       return $query;
   }

   private function fechaFormat($date){
       return date("Y-m-d", strtotime( str_replace('/', '-', $date)));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->hasRoleSlug('admin'))
          $locales = ['Todos'];
        else
        $locales = $user->locales()->where('estado', 'verificado')->pluck('nombre', 'id')->toArray();

        return view('publicaciones::admin.publicacions.create', compact('locales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePublicacionRequest $request
     * @return Response
     */
    public function store(CreatePublicacionRequest $request)
    {
        try{
          DB::beginTransaction();
          $local = Local::find($request->local_id);
          $user = Auth::user();
          if($local->user_id != $user->id)
            return redirect()->route('dashboard.index')->withError('No tiene permiso para realizar la acción');

          $pub = new Publicacion();
          if($user->hasRoleSlug('admin'))
            $pub->global = true;
          else{
            $pub->global = false;
            $pub->local_id = $request->local_id;
          }

          $pub->titulo = $request->titulo;
          $pub->texto = $request->texto;
          $pub->estado = 'publicado';
          $pub->save();
          $pub->addMediaFromBase64($request->logo)->toMediaCollection('img');
          DB::commit();
        }catch(\Exception $e){
          return redirect()->back()->withInput()->withError('Ocurrió un error inesperado');
        }

        return redirect()->route('admin.publicaciones.publicacion.index')
            ->withSuccess('Operación realizada exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Publicacion $publicacion
     * @return Response
     */
    public function edit(Publicacion $publicacion)
    {
        $user = Auth::user();
        $locales = $user->locales()->where('estado', 'verificado')->pluck('id')->toArray();
        if(!in_array($publicacion->local_id, $locales) && !$user->hasRoleSlug('admin'))
          return redirect()->route('admin.publicaciones.publicacion.index')->withError('No tiene permiso para realizar la acción');

        if($user->hasRoleSlug('admin'))
          $locales = ['Todos'];
        else
          $locales = $user->locales()->where('estado', 'verificado')->pluck('nombre', 'id')->toArray();

        $estados = Publicacion::$estados;

        return view('publicaciones::admin.publicacions.edit', compact('publicacion', 'locales', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Publicacion $publicacion
     * @param  UpdatePublicacionRequest $request
     * @return Response
     */
    public function update(Publicacion $publicacion, UpdatePublicacionRequest $request)
    {
        $user = Auth::user();
        $locales = $user->locales()->where('estado', 'verificado')->pluck('id')->toArray();
        if(!in_array($publicacion->local_id, $locales) && !$user->hasRoleSlug('admin'))
          return redirect()->route('admin.publicaciones.publicacion.index')->withError('No tiene permiso para realizar la acción');

        try{
          DB::beginTransaction();
          if($user->hasRoleSlug('admin'))
            unset($request['local_id']);

          $this->publicacion->update($publicacion, $request->all());

          if($request->editar_imagen){
            $publicacion->getMedia('img')->first()->delete();
            $publicacion->addMediaFromBase64($request->imagen)->toMediaCollection('img');
          }

          DB::commit();
        }catch(\Exception $e){
          return redirect()->back()->withInput()->withError('Ocurrió un error inesperado');
        }

        return redirect()->route('admin.publicaciones.publicacion.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('publicaciones::publicacions.title.publicacions')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Publicacion $publicacion
     * @return Response
     */
    public function destroy(Publicacion $publicacion)
    {
        $this->publicacion->destroy($publicacion);

        return redirect()->route('admin.publicaciones.publicacion.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('publicaciones::publicacions.title.publicacions')]));
    }
}
