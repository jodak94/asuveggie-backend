<script type="text/javascript">
  var maxFiles = {{$f_max - count($local->getMedia('galeria'))}}
  var cFiles = {{count($local->getMedia('galeria'))}};
  // var filesCount = 0;
  // var currentFiles = 0;
  // Dropzone.autoDiscover = false;
  // var myDropzone = new Dropzone("#form", {
  //   maxFilesize: 2, // MB
  //   autoProcessQueue: false,
  //   maxFiles: maxFiles,
  //   dictMaxFilesExceeded: 'Excedió el límite de imágenes',
  //   parallelUploads: 6
  // });
  //
  // $('#uploadFilesButton').click(function(){
  //   filesCount = myDropzone.files.length;
  //   currentFiles = 0;
  //   if(filesCount > maxFiles)
  //     filesCount = maxFiles;
  //
  //   myDropzone.processQueue();
  // });
  //
  // $(document).ready(function(){
  //   myDropzone.on("success", function(file) {
  //     currentFiles++;
  //     if(currentFiles == filesCount){
  //       $.toast({
  //           heading: 'Operación exitosa',
  //           text: 'La galeria se actualizó correctamente.',
  //           showHideTransition: 'slide',
  //           icon:'success',
  //           position: 'top-right'
  //       })
  //       setTimeout( function(){
  //         location.reload();
  //       }, 2000);
  //     }
  //   });
  //
  //   myDropzone.on("error", function(file){
  //     $.toast({
  //       heading: 'Error',
  //       text: 'Ocurrió un error al intentar subir una o más imágenes.',
  //       showHideTransition: 'slide',
  //       icon:'error',
  //       position: 'top-right'
  //     })
  //   })
  //
  //   $(".btn-container").hover( function(e){
  //     if(e.type == "mouseenter"){
  //       $(this).find('.btn-delete').css('display', 'block')
  //       $(this).parent().find('.galeria-img-preview').addClass('hover-effect')
  //     }else{
  //       $(this).find('.btn-delete').css('display', 'none')
  //       $(this).parent().find('.galeria-img-preview').removeClass('hover-effect')
  //     }
  //   })
  //
  // })

  var imagen;

  $(document).ready(function(){
      $("#galeria-container").on('mouseenter mouseleave', '.btn-container', function(e){
        if(e.type == "mouseenter"){
          $(this).find('.btn-delete').css('display', 'block')
          $(this).parent().find('.galeria-img-preview').addClass('hover-effect')
        }else{
          $(this).find('.btn-delete').css('display', 'none')
          $(this).parent().find('.galeria-img-preview').removeClass('hover-effect')
        }
      })

    $("#galeriaModalButton").on('click', function(){
      $("#img").croppie('destroy');
      $('#img').attr('src', '');
      $("#galeriaModal").modal('show');
    })

    $("#img-input").change(function() {
        readURL(this);
    });

    $("#addFileButton").on('click', function(){
      $('#img').croppie('result', {type: 'base64' }).then(function(base){
        uploadFile(base)
      })
    })
  })


  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#img').attr('src', e.target.result);
              $("#img-container").css('display', 'block')
              imagen = $('#img').croppie({
                viewport: { width: 300, height: 200 },
                boundary: { width: 400, height: 300 },
              });
          }
          reader.readAsDataURL(input.files[0]);
      }
  }

  function uploadFile(base){
    $("#spin").show();
    $.ajax({
      url: '{{route('admin.locales.local.store_galeria_ajax', $local->id)}}',
      type: 'POST',
      data: {
        'file': base,
        "_token": "{{ csrf_token() }}",
      },
      success: function(data){
        if(data.error){
          mostrar_error(data.message)
          $("#spin").hide();
          $("#galeriaModal").modal('hide');
          return;
        }
        let html = ''
        +'<div class="col-md-4" style="margin-bottom: 25px;">'
        +  '<img src="'+base+'" class="galeria-img-preview">'
        +  '<div class="btn-container">'
        +    '<button class="btn btn-default btn-delete" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="'+data.delete_route+'">Eliminar</button>'
        +  '</div>'
        +'</div>';
        $("#galeria-container").append(html);
        $("#spin").hide();
        mostrar_mensaje(data.message)
        cFiles++;
        if(cFiles >= {{$f_max}})
          $("#galeriaModalButton").prop('disabled', true);
        $("#galeriaModal").modal('hide');
      },
      error: function(error){
        $("#spin").hide();
        mostrar_error("Ocurrio un error inesperado")
      }
    })

    function mostrar_error(message){
        $.toast({
            heading: 'Error',
            text: message,
            showHideTransition: 'slide',
            icon:'error',
            position: 'top-right'
        })
    }

    function mostrar_mensaje(message){
        $.toast({
          heading: 'Operación exitosa',
          text: message,
          showHideTransition: 'slide',
          icon:'success',
          position: 'top-right'
        })
    }
  }
</script>
