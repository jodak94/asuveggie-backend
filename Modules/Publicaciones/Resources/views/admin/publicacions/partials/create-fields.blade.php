<div class="box-body">
  <div class="row">
    <div class="col-md-6">
      {{-- <div class="col-md-12">
        {!! Form::normalInput('titulo', 'Titulo', $errors, null,  ['required' => 'true']) !!}
      </div> --}}
      <div class="col-md-12">
        <div class="form-group">
          <label>Publicación</label>
          <textarea id="texto" name="texto" placeholder="Publicación" style="resize:none;width:100%;" class="form-control" rows="5"></textarea>
        </div>
      </div>
      <div class="col-md-12">
        {!! Form:: normalSelect('local_id', 'Local', $errors, $locales) !!}
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
