@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('locales::locals.title.create local') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.locales.local.index') }}">{{ trans('locales::locals.title.locals') }}</a></li>
        <li class="active">{{ trans('locales::locals.title.create local') }}</li>
    </ol>
     {!! Theme::style('vendor/croppie/croppie.css') !!}
     {!! Theme::style('vendor/leaflet/leaflet.css') !!}
     {!! Theme::style('vendor/pickadate/css/classic.css') !!}
     {!! Theme::style('vendor/pickadate/css/classic.date.css') !!}
     {!! Theme::style('vendor/pickadate/css/classic.time.css') !!}
@stop
@push('css-stack')
  <style>
    .logo{
      display: none;
      margin: auto;
      max-width: 350;
      max-height: 350;
    }
    #logo-container{
      margin-top: 15px;
      display: none;
    }
    .center{
      text-align: center;
    }
    .mid-text{
      margin-top: 5px;
    }
    .margin-bottom{
      margin-bottom: 10px;
    }
  </style>
@endpush
@section('content')
    {!! Form::open(['route' => ['admin.locales.local.store'], 'method' => 'post', 'id' => 'form']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('locales::admin.locals.partials.create-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('dashboard.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
    {!! Theme::script('vendor/leaflet/leaflet.js') !!}
    {!! Theme::script('vendor/croppie/croppie.min.js') !!}
    {!! Theme::script('vendor/pickadate/js/picker.js') !!}
    {!! Theme::script('vendor/pickadate/js/picker.date.js') !!}
    {!! Theme::script('vendor/pickadate/js/picker.time.js') !!}
    @include('locales::admin.locals.partials.script')
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
