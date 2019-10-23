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
    </div>
    <div class="col-md-6">
      <div class="col-md-12">
        <div class="form-group">
          {!! Form::label('image','Logo')!!}
          {!! Form::file('image',['class' => 'form-control','id' => 'img-input']) !!}
          <div id="logo-container">
            <img id="logo" src="{{$local->getMedia('logo')->first()->getUrl()}}" class="logo"/>
            <input name="logo" style="display:none" id="logo-img">
          </div>
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
