<script type="text/javascript">
  var maxFiles = 6
  var filesCount = 0;
  var currentFiles = 0;
  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("#form", {
    maxFilesize: 2, // MB
    autoProcessQueue: false,
    maxFiles: maxFiles,
    dictMaxFilesExceeded: 'Excedió el límite de imágenes',
    parallelUploads: 5
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
        text: 'Ocurrió un error al subir una o más imágenes, asegurese de estar conectado a internet y no haber sobrepasado el límite de imágenes, refresque la página y vuelva a intentarlo.',
        showHideTransition: 'slide',
        icon:'error',
        position: 'top-right'
      })
    })
  })
</script>
