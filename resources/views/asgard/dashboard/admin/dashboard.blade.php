@extends('layouts.master')
@php
  $user = Auth::user();
@endphp
@section('content-header')
    <h1>
        Bienvenido {{$user->first_name . ' ' . $user->last_name}}
    </h1>
@stop

@section('styles')
  <style>
  .titulo{font-weight: 500;color:black;}
  /* .box{
    background: rgba(255,255,255,0.85)!important;
    border-top-color:#2F444E !important;
  } */
  .small-box{
    background-color: #0d571a;
  }
  .small-box-footer{
    background-color: #6dab3c!important;
  }
  .btn-crear{
    /* background-color: #6dab3c; */
    /* background-color: #64b246; */
    /* background-color: #0d571a; */
    background-color: #00a65a;
    width: 100%;
    height: 120px;
    color: #fff;
    font-size: 18px;
    font-weight: 500px;
    border: none;
    border-radius: 2px;
    margin-bottom: 40px;
  }
  .btn-crear-2{
    background-color: #00a65a;
  }
  .logo{
    width: 50px;
    height: auto;
  }
  .capitalize{
    text-transform:capitalize
  }
  </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (setting('dashboard::welcome-enabled') === '1')
              <div class="box box-primary">
                  <div class="box-header">
                    @if(count($user->locales()->where('estado', '!=', 'eliminado')->get()))
                      <h3 class="box-title">
                        Mis locales
                      </h3>
                      <a class="pull-right" href="{{route('admin.locales.local.create')}}">
                        <button class="btn btn-primary btn-flat">Crear Nuevo Local</button>
                      </a>
                    @endif
                  </div>
                  <div class="box-body">
                    @if(count($user->locales()->where('estado', '!=', 'eliminado')->get()))
                      <div class="table-responsive">
                          <table class="data-table table table-bordered table-hover">
                              <thead>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Teléfono</th>
                                  <th>Logo</th>
                                  <th>Estado</th>
                                  <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php if (isset($user->locales)): ?>
                              <?php foreach ($user->locales()->where('estado', '!=', 'eliminado')->get() as $local): ?>
                              <tr>
                                  <td>
                                      <a href="{{ route('admin.locales.local.edit', [$local->id]) }}">
                                          {{ $local->nombre }}
                                      </a>
                                  </td>
                                  <td>
                                      <a href="{{ route('admin.locales.local.edit', [$local->id]) }}">
                                          {{ $local->telefono }}
                                      </a>
                                  </td>
                                  <td>
                                    <img src="{{$local->getMedia('logo')->first()->getUrl()}}" class="logo">
                                  </td>
                                  <td class="capitalize">
                                    {{ $local->estado }}
                                  </td>
                                  <td>
                                      <div class="btn-group">
                                          <a href="{{ route('admin.locales.local.edit', [$local->id]) }}" class="btn btn-default btn-flat" title="Editar"><i class="fa fa-pencil"></i></a>
                                          <a href="{{ route('admin.locales.local.galeria', [$local->id]) }}" class="btn btn-default btn-flat" title="Galería"><i class="fa fa-camera"></i></a>
                                          <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" title="Eliminar" data-action-target="{{ route('admin.locales.local.destroy', [$local->id]) }}"><i class="fa fa-trash"></i></button>
                                      </div>
                                  </td>
                              </tr>
                              <?php endforeach; ?>
                              <?php endif; ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Teléfono</th>
                                  <th>Logo</th>
                                  <th>Estado</th>
                                  <th>{{ trans('core::core.table.actions') }}</th>
                              </tr>
                              </tfoot>
                          </table>
                      </div>
                    @else
                      <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                          <a href="{{route('admin.locales.local.create')}}">
                            <button class="btn-crear">Crear Nuevo Local</button>
                          </a>
                        </div>
                      </div>
                    @endif
                </div>
              </div>
            @endif
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop
