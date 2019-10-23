<?php

namespace Modules\Locales\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Locales\Entities\Local;
use Modules\Locales\Http\Requests\CreateLocalRequest;
use Modules\Locales\Http\Requests\UpdateLocalRequest;
use Modules\Locales\Repositories\LocalRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class LocalController extends AdminBaseController
{
    /**
     * @var LocalRepository
     */
    private $local;

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

        return view('locales::admin.locals.index', compact('locals'));
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

        $local = $this->local->create($request->all());

        $local->addMediaFromBase64($request->logo)->toMediaCollection('logo');
        return redirect()->route('admin.locales.local.index')
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
        return view('locales::admin.locals.edit', compact('local'));
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
        $local = $this->local->update($local, $request->all());

        $local->getMedia('logo')->first()->delete();
        $local->addMediaFromBase64($request->logo)->toMediaCollection('logo');


        return redirect()->route('admin.locales.local.index')
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
        // dd($local);
        $this->local->destroy($local);

        return redirect()->route('admin.locales.local.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('locales::locals.title.locals')]));
    }
}
