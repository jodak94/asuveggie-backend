@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('locales::locals.title.locals') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('locales::locals.title.locals') }}</li>
    </ol>
@stop
@push('css-stack')
  <style>
    .logo{
      width: 50px;
      height: auto;
    }
    .capitalize{
      text-transform:capitalize
    }
  </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.locales.local.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('locales::locals.button.create local') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Logo</th>
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>Destacado</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($locals)): ?>
                            <?php foreach ($locals as $local): ?>
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
                                  {{ $local->ciudad->nombre }}
                                </td>
                                <td class="capitalize">
                                  {{ $local->estado }}
                                </td>
                                <td>
                                  @if($local->destacado) Sí @else No @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.locales.local.edit', [$local->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.locales.local.destroy', [$local->id]) }}"><i class="fa fa-trash"></i></button>
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
                                <th>Ciudad</th>
                                <th>Estado</th>
                                <th>Destacado</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
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
        <dd>{{ trans('locales::locals.title.create local') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.locales.local.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
