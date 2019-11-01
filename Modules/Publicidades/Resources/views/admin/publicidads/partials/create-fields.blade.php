<div class="box-body">
  <div class="row">
    <div class="col-md-6">
      <div class="col-md-12">
        {!! Form:: normalCheckbox('activo', 'Activo', $errors) !!}
      </div>
      <div class="col-md-12">
        {!! Form:: normalSelect('ubicacion', 'Ubicación', $errors, $ubicaciones, null) !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="col-md-12">
        <div class="form-group">
          {!! Form::label('image','Imagen')!!}
          {!! Form::file('image',['class' => 'form-control','id' => 'img-input']) !!}
          <div id="imagen-container">
            <img id="imagen" src="" class="imagen"/>
            <input name="logo" style="display:none" id="imagen-img">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
