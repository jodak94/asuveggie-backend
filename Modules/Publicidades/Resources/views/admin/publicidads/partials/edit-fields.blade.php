<div class="box-body">
  <div class="row">
    <div class="col-md-6">
      <div class="col-md-12">
        {!! Form:: normalCheckbox('activo', 'Activo', $errors, $publicidad) !!}
      </div>
      <div class="col-md-12">
        {!! Form:: normalSelect('ubicacion', 'Ubicación', $errors, $ubicaciones, $publicidad) !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="col-md-3">
        <div class="form-group">
          <label style="color:white">.</label><br>
          <button type="button" class="btn btn-primary pull-right btn-flat" id="edit-imagen-button">Editar Imagen</button>
          <input type="hidden" id="editar_imagen" name="editar_imagen" value="0"></input>
        </div>
      </div>
      <div class="col-md-9">
        <div class="form-group" id="input-file-container" style="display:none">
          {!! Form::label('image','Imagen')!!}
          {!! Form::file('image',['class' => 'form-control','id' => 'img-input']) !!}
        </div>
      </div>
      <div class="col-md-12">
        <div id="imagen-container">
          <img id="imagen" class="imagen" src="{{$publicidad->getMedia('img')->first()->getUrl()}}"/>
          <input name="imagen" style="display:none" id="imagen-img">
        </div>
      </div>
    </div>
  </div>
</div>
