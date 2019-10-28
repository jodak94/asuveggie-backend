<script type="text/javascript">
  var maxFiles = {{$f_max - count($local->getMedia('galeria'))}}
  console.log(maxFiles);
  var filesCount = 0;
  var currentFiles = 0;
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("#form", {
    maxFilesize: 2, // MB
    autoProcessQueue: false,
    maxFiles: maxFiles,
    dictMaxFilesExceeded: 'Excedió el límite de imágenes',
    parallelUploads: 6
  });

  $('#uploadFilesButton').click(function(){
    filesCount = myDropzone.files.length;
    currentFiles = 0;
    if(filesCount > maxFiles)
      filesCount = maxFiles;

    myDropzone.processQueue();
  });

  $(document).ready(function(){
    myDropzone.on("success", function(file) {
      currentFiles++;
      if(currentFiles == filesCount){
        $.toast({
            heading: 'Operación exitosa',
            text: 'La galeria se actualizó correctamente.',
            showHideTransition: 'slide',
            icon:'success',
            position: 'top-right'
        })
        setTimeout( function(){
          location.reload();
        }, 2000);
      }
    });

    myDropzone.on("error", function(file){
      $.toast({
        heading: 'Error',
        text: 'Ocurrió un error al intentar subir una o más imágenes.',
        showHideTransition: 'slide',
        icon:'error',
        position: 'top-right'
      })
    })

    $(".btn-container").hover( function(e){
      if(e.type == "mouseenter"){
        $(this).find('.btn-delete').css('display', 'block')
        $(this).parent().find('.galeria-img-preview').addClass('hover-effect')
      }else{
        $(this).find('.btn-delete').css('display', 'none')
        $(this).parent().find('.galeria-img-preview').removeClass('hover-effect')
      }
    })

  })
</script>
