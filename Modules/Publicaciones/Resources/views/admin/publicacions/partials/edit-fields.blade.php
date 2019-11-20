<div class="box-body">
  <div class="row">
    <div class="col-md-6">
      {{-- <div class="col-md-12">
        {!! Form::normalInput('titulo', 'Titulo', $errors, $publicacion,  ['required' => 'true']) !!}
      </div> --}}
      <div class="col-md-12">
        <div class="form-group">
          <label>Publicación</label>
          <textarea id="texto" name="texto" placeholder="Publicación" style="resize:none;width:100%;" class="form-control" rows="5">{{$publicacion->texto}}</textarea>
        </div>
      </div>
      <div class="col-md-12">
        {!! Form:: normalSelect('local_id', 'Local', $errors, $locales, $publicacion) !!}
      </div>
      @if(Auth::user()->hasRoleSlug('admin'))
        <div class="col-md-12">
          {!! Form:: normalSelect('estado', 'Estado', $errors, $estados, $publicacion) !!}
        </div>
      @endif
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
          <img id="imagen" class="imagen" src="{{$publicacion->getMedia('img')->first()->getUrl()}}"/>
          <input name="imagen" style="display:none" id="imagen-img">
        </div>
      </div>
    </div>
  </div>
</div>
