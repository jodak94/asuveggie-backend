<script type="text/javascript">
  var ok;
  var imagen
  $( document ).ready(function() {
    $("#img-input").change(function() {
        readURL(this);
    });
    $("#form").on('submit', function(e){
        let ok = true;
        if(imagen == undefined){
          mostrar_error("La imagen es obligatoria")
          ok = false;
        }
        if(ok)
          $('#imagen').croppie('result', { type: 'base64' }).then(function(base){
            $("#imagen-img").val(base)
          })
        else
          e.preventDefault();
    })

  });
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagen').attr('src', e.target.result);
            if(imagen != undefined)
              $("#imagen").croppie('destroy');

            $("#imagen-container").css('display', 'block')
            imagen = $('#imagen').croppie({
              viewport: { width: 300, height: 300 },
              boundary: { width: 400, height: 400 },
            });
        }
        reader.readAsDataURL(input.files[0]);
    }
  }
</script>
