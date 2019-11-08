<div class="box-body">
  <div class="row">
    <div class="col-md-6">
      <div class="col-md-12">
        {!! Form::normalInput('nombre', 'Nombre', $errors, null,  ['required' => 'true']) !!}
      </div>
      <div class="col-md-12">
        {!! Form::normalInput('telefono', 'Teléfono', $errors, null,  ['required' => 'true']) !!}
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Descripción</label>
          <textarea id="descripcion" required name="descripcion" placeholder="Descripción" style="resize:none;width:100%;" class="form-control" rows="5"></textarea>
        </div>
      </div>
      <div class="col-md-12">
        {!! Form::normalInput('direccion', 'Dirección', $errors, null,  ['required' => 'true']) !!}
      </div>
      <div class="col-md-12">
        <label for="paciente_id">Ciudad</label>
        <div class="form-group ">
          <input placeholder="Ciudad" type="text" id="buscar-ciudad" class="form-control">
          <input type="hidden" name="ciudad_id" id="ciudad_id">
        </div>
      </div>
      <div class="col-md-12">
        <label>Horarios</label>
      </div>
      <div class="col-md-12" id="horarios-container">
        <div id="h-0" class="row margin-bottom">
          <div class="col-md-2" style="padding-right: 0;">
            <select name="dia_inicio[]" class="form-control">
              @foreach ($dias as $key => $dia)
                <option @if($key == 0) selected @endif value={{$dia}}>{{$dia}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-1 no-padding center mid-text">a</div>
          <div class="col-md-2 no-padding center">
            <select name="dia_fin[]" class="form-control">
              @foreach ($dias as $key => $dia)
                <option @if($key == 6) selected @endif value={{$dia}}>{{$dia}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-1 no-padding center mid-text">de</div>
          <div class="col-md-2 no-padding center">
            <input name="hora_inicio[]" type="text" id="hora_inicio" class="time form-control" value="18:00">
          </div>
          <div class="col-md-1 no-padding center mid-text">a</div>
          <div class="col-md-2 no-padding center">
            <input name="hora_fin[]" type="text" id="hora_inicio" class="time form-control" value="23:30">
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
      <div class="col-md-6" style="margin-top: 15px">
        <button id="add-horario-button" class="btn btn-default btn-flat" type="button" title="Agregar Horario"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Horario</button>
      </div>
    </div>
    <div class="col-md-6">
      <div class="col-md-12">
        <div class="form-group">
          {!! Form::label('image','Logo')!!}
          {!! Form::file('image',['class' => 'form-control','id' => 'img-input']) !!}
          <div id="logo-container">
            <img id="logo" src="" class="logo"/>
            <input name="logo" style="display:none" id="logo-img">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top: 15px;">
    <div class="col-md-12">
      <div id="map" style="width: 100%; height: 400px;"></div>
      <input type="hidden" name="latitud" id="latitud">
      <input type="hidden" name="longitud" id="longitud">
    </div>
  </div>
</div>
