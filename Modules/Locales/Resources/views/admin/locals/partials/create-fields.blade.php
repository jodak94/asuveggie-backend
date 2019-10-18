<div class="box-body">
  <div class="row">
    <div class="col-md-6">
      {!! Form::normalInput('nombre', 'Nombre', $errors, null,  ['required' => 'true']) !!}
    </div>
    <div class="col-md-6">
      {!! Form::normalInput('telefono', 'Teléfono', $errors, null,  ['required' => 'true']) !!}
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <label>Descripción</label>
          <textarea id="descripcion" required name="descripcion" placeholder="Descripción" style="resize:none;width:100%;" class="form-control" rows="5"></textarea>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          {!! Form::normalInput('direccion', 'Dirección', $errors, null,  ['required' => 'true']) !!}
        </div>
        <div class="col-md-12">
          {!! Form::normalCheckbox('solo_delivery', 'Sólo Delivery', $errors) !!}
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
