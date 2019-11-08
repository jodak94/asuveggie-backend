<?php

namespace Modules\Ciudades\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Ciudades\Entities\Ciudad;
use Modules\Ciudades\Http\Requests\CreateCiudadRequest;
use Modules\Ciudades\Http\Requests\UpdateCiudadRequest;
use Modules\Ciudades\Repositories\CiudadRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CiudadController extends AdminBaseController
{
    /**
     * @var CiudadRepository
     */
    private $ciudad;

    public function __construct(CiudadRepository $ciudad)
    {
        parent::__construct();

        $this->ciudad = $ciudad;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ciudads = $this->ciudad->all();
        return view('ciudades::admin.ciudads.index', compact('ciudads'));
    }

    public function search_ajax(Request $request){
      $sub = Ciudad::select('*', 'nombre as value')
        ->where('nombre', 'like', '%'.$request->term.'%')->take(5)->get()->toArray();

      return response()->json($sub);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('ciudades::admin.ciudads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCiudadRequest $request
     * @return Response
     */
    public function store(CreateCiudadRequest $request)
    {
        $this->ciudad->create($request->all());

        return redirect()->route('admin.ciudades.ciudad.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('ciudades::ciudads.title.ciudads')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ciudad $ciudad
     * @return Response
     */
    public function edit(Ciudad $ciudad)
    {
        return view('ciudades::admin.ciudads.edit', compact('ciudad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Ciudad $ciudad
     * @param  UpdateCiudadRequest $request
     * @return Response
     */
    public function update(Ciudad $ciudad, UpdateCiudadRequest $request)
    {
        $this->ciudad->update($ciudad, $request->all());

        return redirect()->route('admin.ciudades.ciudad.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('ciudades::ciudads.title.ciudads')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ciudad $ciudad
     * @return Response
     */
    public function destroy(Ciudad $ciudad)
    {
        $this->ciudad->destroy($ciudad);

        return redirect()->route('admin.ciudades.ciudad.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('ciudades::ciudads.title.ciudads')]));
    }
}
