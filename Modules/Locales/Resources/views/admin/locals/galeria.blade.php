@extends('layouts.master')

@section('content-header')
    <h1>
        Galería
    </h1>
    {!! Theme::style('vendor/dropzone/dropzone.min.css') !!}
@stop
@push('css-stack')
  <style>
    .dropzone{
      border: 2px dashed #00a65a!important;
      border-radius: 5px!important;
    }
    .custom-box{
      background-color: #ecf0f5;
      border: 2px solid #00a65a;
      padding: 10px 10px 10px 0px;
    }
    .btn-upload{
      margin: auto;
      margin-top: 20px;
      border-radius: 3px;
      display: block;
    }
    .galeria-img-preview{
      width: 90%;
      margin: auto;
    }
  </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('locales::admin.locals.partials.galeria-fields')
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <a class="btn btn-primary btn-flat" href="{{ route('dashboard.index')}}"> Volver</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    {!! Theme::script('vendor/dropzone/dropzone.min.js') !!}
    @include('locales::admin.locals.partials.galeria-script')
@endpush
