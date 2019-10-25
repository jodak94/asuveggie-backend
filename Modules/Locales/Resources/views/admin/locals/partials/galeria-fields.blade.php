@if(count($local->getMedia('galeria')))
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
          <div class="col-md-2">
            <img src="{{$file->getUrl()}}" class="galeria-img-preview">
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
            <li>Pueden levantar hasta 6 imágenes en su galeria.</li>
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
</div>
