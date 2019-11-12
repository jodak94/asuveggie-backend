{{-- @if(count($local->getMedia('galeria')))
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Galería</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body no-padding">
      <div class="row">
        @foreach ($local->getMedia('galeria') as $file)
          <div class="col-md-2" style="margin-bottom: 25px;">
            <img src="{{$file->getUrl()}}" class="galeria-img-preview">
            <div class="btn-container">
              <button class="btn btn-default btn-delete" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.locales.local.delete_file', [$local->id, $file->id]) }}">Eliminar</button>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Agregar Fotos</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body no-padding">
    <div class="row" style="margin-bottom: 20px;">
      <div class="col-md-6 col-md-offset-1">
        {!! Form::open(['route' => ['admin.locales.local.store_galeria', $local->id], 'method' => 'post', 'id' => 'form', 'class' => 'dropzone', 'files' => true]) !!}
          <div class="dz-message" data-dz-message><span>Arraste y suelte sus imágenes.</span></div>
          <div class="fallback">
            <input name="file" type="file" multiple />
          </div>
        {!! Form::close() !!}
      </div>
      <div class="col-md-4">
        <div class="custom-box">
          <ul>
            <li>Arrastre y suelte sus imágenes en el cuadro.</li>
            <li>También puede hacer click y seleccionar sus imágenes.</li>
            <li>Pueden levantar hasta {{$f_max}} imágenes en su galeria.</li>
            <li>Cada imágen puede pesar hasta 2 MB.</li>
            <li>Una vez que ya tenga todas las imagenes seleccionadas en el cuadro presione el botón "Subir".</li>
            <li>Las imágenes se iran subiendo de a 1, no abandone la ventana hasta que termine de subir todas las imágenes.</li>
            <li>Si no quiere realizar cambios presione el botón "Volver"</li>
          </ul>
        </div>
        <button type="button" class="btn btn-primary btn-upload" id="uploadFilesButton"><i class="fa fa-upload" aria-hidden="true"></i> Subir</button>
      </div>
    </div>
  </div>
</div> --}}

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Galería</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body no-padding">
    <div class="row">
      <div class="col-md-6" id="galeria-container">
        @foreach ($local->getMedia('galeria') as $file)
          <div class="col-md-4" style="margin-bottom: 25px;">
            <img src="{{$file->getUrl()}}" class="galeria-img-preview">
            <div class="btn-container">
              <button class="btn btn-default btn-delete" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.locales.local.delete_file', [$local->id, $file->id]) }}">Eliminar</button>
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-6">
        <div class="custom-box">
          <ul>
            <li>Pueden levantar hasta {{$f_max}} imágenes en su galeria.</li>
            <li>Click en Nueva Foto.</li>
            <li>Se desplega una vista para subir y editar la imágen.</li>
            <li>La imagen está en una proporción de 3:4 para una mejor visualización en la aplicación.</li>
            <li>Para eliminar debe posicionar el puntero sobre la imagen y presionar en "Eliminar".</li>
            <li>Si no quiere realizar cambios presione el botón "Volver".</li>
          </ul>
        </div>
        <button @if(count($local->getMedia('galeria')) >= $f_max) disabled @endif id="galeriaModalButton" type="button" class="btn btn-primary btn-upload"><i class="fa fa-upload" aria-hidden="true"></i> Nueva Foto</button>
      </div>
    </div>
  </div>
</div>
