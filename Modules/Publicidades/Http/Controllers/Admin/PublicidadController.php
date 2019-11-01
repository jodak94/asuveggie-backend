<?php

namespace Modules\Publicidades\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Publicidades\Entities\Publicidad;
use Modules\Publicidades\Http\Requests\CreatePublicidadRequest;
use Modules\Publicidades\Http\Requests\UpdatePublicidadRequest;
use Modules\Publicidades\Repositories\PublicidadRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use DB;
class PublicidadController extends AdminBaseController
{
    /**
     * @var PublicidadRepository
     */
    private $publicidad;

    public function __construct(PublicidadRepository $publicidad)
    {
        parent::__construct();

        $this->publicidad = $publicidad;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $publicidads = $this->publicidad->all();

        return view('publicidades::admin.publicidads.index', compact('publicidads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $ubicaciones = Publicidad::$ubicaciones;
        return view('publicidades::admin.publicidads.create', compact('ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePublicidadRequest $request
     * @return Response
     */
    public function store(CreatePublicidadRequest $request)
    {
        try{
          DB::beginTransaction();
          $publicacion = $this->publicidad->create($request->all());
          $publicacion->addMediaFromBase64($request->logo)->toMediaCollection('img');
          DB::commit();
        }catch(\Exception $e){
          return redirect()->back()->withInput()->withError('Ocurrió un error inesperado');
        }


        return redirect()->route('admin.publicidades.publicidad.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('publicidades::publicidads.title.publicidads')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Publicidad $publicidad
     * @return Response
     */
    public function edit(Publicidad $publicidad)
    {
        $ubicaciones = Publicidad::$ubicaciones;
        return view('publicidades::admin.publicidads.edit', compact('publicidad','ubicaciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Publicidad $publicidad
     * @param  UpdatePublicidadRequest $request
     * @return Response
     */
    public function update(Publicidad $publicidad, UpdatePublicidadRequest $request)
    {
        try{
          DB::beginTransaction();
          $this->publicidad->update($publicidad, $request->all());

          if($request->editar_imagen){
            $publicidad->getMedia('img')->first()->delete();
            $publicidad->addMediaFromBase64($request->imagen)->toMediaCollection('img');
          }
          DB::commit();
        }catch(\Exception $e){
          return redirect()->back()->withInput()->withError('Ocurrió un error inesperado');
        }

        return redirect()->route('admin.publicidades.publicidad.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('publicidades::publicidads.title.publicidads')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Publicidad $publicidad
     * @return Response
     */
    public function destroy(Publicidad $publicidad)
    {
        $this->publicidad->destroy($publicidad);

        return redirect()->route('admin.publicidades.publicidad.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('publicidades::publicidads.title.publicidads')]));
    }
}
