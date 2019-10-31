@extends('layouts.master')

@section('content-header')
    <h1>
        Publicaciones
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('publicaciones::publicacions.title.publicacions') }}</li>
    </ol>
@stop
@push('css-stack')
    {!! Theme::style('vendor/pickadate/css/classic.css') !!}
    {!! Theme::style('vendor/pickadate/css/classic.date.css') !!}
    {!! Theme::style('vendor/pickadate/css/classic.time.css') !!}
    <style>
      .picker__select--year{
        padding: 1px;
      }
      .picker__select--month{
        padding: 1px;
      }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.publicaciones.publicacion.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> Crear Publicación
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                  <div class="row">
                    <div class="col-md-3">
                      {!! Form::normalInput('local', 'Local', $errors) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::normalInput('fecha_desde', 'Fecha desde', $errors,null,['class'=>'form-control fecha','id'=>'fecha_desde']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::normalInput('fecha_hasta', 'Fecha hasta', $errors,null,['class'=>'form-control fecha','id'=>'fecha_hasta']) !!}
                    </div>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                      <table class="data-table table table-bordered table-hover">
                          <thead>
                          <tr>
                              <th>Título</th>
                              <th>Fecha</th>
                              <th>Local</th>
                              <th>Estado</th>
                              <th>Acciones</th>
                          </tr>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot>
                            <th>Título</th>
                            <th>Fecha</th>
                            <th>Local</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                          </tfoot>
                      </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('publicaciones::publicacions.title.create publicacion') }}</dd>
    </dl>
@stop
@push('js-stack')
  {!! Theme::script('vendor/pickadate/js/picker.js') !!}
  {!! Theme::script('vendor/pickadate/js/picker.date.js') !!}
  {!! Theme::script('vendor/pickadate/js/picker.time.js') !!}
  @include('publicaciones::admin.publicacions.partials.script-index')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.publicaciones.publicacion.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>

@endpush
