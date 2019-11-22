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
                @if($user->hasRoleSlug('admin'))
                  @include('dashboard::partials.admin')
                @else
                  @include('dashboard::partials.user')
                @endif
              </div>
            @endif
        </div>
    </div>
    @include('core::partials.delete-modal')
    @include('dashboard::partials.modal-contacto')
@stop
