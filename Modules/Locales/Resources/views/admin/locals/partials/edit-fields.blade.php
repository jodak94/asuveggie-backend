<div class="box-body">
  <div class="row">
    <div class="col-md-6">
      <div class="col-md-12">
        {!! Form::normalInput('nombre', 'Nombre', $errors, $local,  ['required' => 'true']) !!}
      </div>
      <div class="col-md-12">
        {!! Form::normalInput('telefono', 'Teléfono', $errors, $local,  ['required' => 'true']) !!}
      </div>
      <div class="col-md-12">
        <label>Descripción</label>
        <textarea id="descripcion" required name="descripcion" placeholder="Descripción" style="resize:none;width:100%;" class="form-control" rows="5">{{$local->descripcion}}</textarea>
      </div>
      <div class="col-md-12">
        {!! Form::normalInput('direccion', 'Dirección', $errors, $local) !!}
      </div>
      @if(Auth::user()->hasRoleSlug('admin'))
        <div class="col-md-12">
          {!! Form:: normalSelect('estado', 'Estado', $errors, $estados, $local) !!}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <div class="col-md-3">
        <div class="form-group">
          <label style="color:white">.</label><br>
          <button type="button" class="btn btn-primary pull-right btn-flat" id="edit-logo-button">Editar Logo</button>
          <input type="hidden" id="editar_logo" name="editar_logo" value="0"></input>
        </div>
      </div>
      <div class="col-md-9">
        <div class="form-group" id="input-file-container" style="display:none">
          {!! Form::label('image','Logo')!!}
          {!! Form::file('image',['class' => 'form-control','id' => 'img-input']) !!}
        </div>
      </div>
      <div class="col-md-12">
        <div id="logo-container">
          <img id="logo" src="{{$local->getMedia('logo')->first()->getUrl()}}" class="logo"/>
          <input name="logo" style="display:none" id="logo-img">
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top: 15px;">
    <div class="col-md-12">
      <div id="map" style="width: 100%; height: 400px; @if($local->solo_delivery) display:none; @endif"></div>
        <input type="hidden" name="latitud" id="latitud" value="{{$local->latitud}}">
        <input type="hidden" name="longitud" id="longitud" value="{{$local->longitud}}">
      </div>
  </div>
</div>
