<div class="modal fade" id="galeriaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Nueva Imagen</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          {!! Form::label('image','Imagen')!!}
          {!! Form::file('image',['class' => 'form-control','id' => 'img-input']) !!}
          <div id="img-container" style="margin-top: 10px">
            <img id="img" src=""/>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" id="addFileButton">Guardar <i id="spin" style="display:none" class="fa fa-spinner fa-spin" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
