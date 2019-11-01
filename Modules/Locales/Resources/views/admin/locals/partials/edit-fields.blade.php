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
      <div class="col-md-12">
        <label>Horarios</label>
      </div>
      <div class="col-md-12" id="horarios-container">
        @foreach ($local->horarios as $hkey => $horario)
          <div id="h-{{$hkey}}" class="row margin-bottom">
            <div class="col-md-2" style="padding-right: 0;">
              <select name="dia_inicio[]" class="form-control">
                @foreach ($dias as $key => $dia)
                  <option @if($dia == $horario->dia_inicio) selected @endif value={{$dia}}>{{$dia}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-1 no-padding center mid-text">a</div>
            <div class="col-md-2 no-padding center">
              <select name="dia_fin[]" class="form-control">
                @foreach ($dias as $key => $dia)
                  <option @if($dia == $horario->dia_fin) selected @endif value={{$dia}}>{{$dia}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-1 no-padding center mid-text">de</div>
            <div class="col-md-2 no-padding center">
              <input name="hora_inicio[]" type="text" id="hora_inicio" class="time form-control" value="{{$horario->hora_inicio}}">
            </div>
            <div class="col-md-1 no-padding center mid-text">a</div>
            <div class="col-md-2 no-padding center">
              <input name="hora_fin[]" type="text" id="hora_inicio" class="time form-control" value="{{$horario->hora_fin}}">
            </div>
            <div class="col-md-1">
              @if($hkey != 0)
                <button type="button" class="btn btn-danger btn-flat delete-button"><i class="fa fa-trash"></i></button>
              @endif
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-6" style="margin-top: 15px">
        <button id="add-horario-button" class="btn btn-default btn-flat" type="button" title="Agregar Horario"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Horario</button>
      </div>
      @if(Auth::user()->hasRoleSlug('admin'))
        <div class="col-md-12">
          {!! Form:: normalSelect('estado', 'Estado', $errors, $estados, $local) !!}
        </div>
        <div class="col-md-12">
          {!! Form:: normalCheckbox('destacado', 'Destacado', $errors) !!}
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
