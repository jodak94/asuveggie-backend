@extends('layouts.master')

@section('content-header')
    <h1>
        Galería
    </h1>
    {!! Theme::style('vendor/dropzone/dropzone.min.css') !!}
@stop

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
                        <button id="submit-button" class="btn btn-primary btn-flat">Aceptar</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.locales.local.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
