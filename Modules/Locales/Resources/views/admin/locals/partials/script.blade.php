<script type="text/javascript">
    @php
        if(isset($local) && !$local->solo_delivery){
            $init_latitud = $local->latitud;
            $init_longitud = $local->longitud;
        }else{
            $init_latitud = -25.29391;
            $init_longitud = -57.61148;
        }

    @endphp

    var map = L.map('map').setView([{{$init_latitud}}, {{$init_longitud}}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = undefined;
    @if(isset($local) && !$local->solo_delivery)
        marker = L.marker([{{$init_latitud}}, {{$init_longitud}}]).addTo(map);
    @endif

    map.on('click', function(e) {
      $("#latitud").val(e.latlng.lat)
      $("#longitud").val(e.latlng.lng)
      if (marker != undefined)
          map.removeLayer(marker);
      marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
    });

    var logo;
    var ok = false;
    $( document ).ready(function() {
        $("#img-input").change(function() {
            readURL(this);
        });

        $("#form").on('submit', function(e){
            let ok = true;
            if(logo == undefined){
              mostrar_error("El logo es obligatorio")
              ok = false;
            }
            if($("#latitud").val() == '' || $("#latitud").val() == undefined || $("#longitud").val() == '' || $("#longitud").val() == undefined){
              mostrar_error("Debe seleccionar una ubicación")
              ok = false;
            }
            if(ok)
              $('#logo').croppie('result', { circle: true, type: 'base64' }).then(function(base){
                $("#logo-img").val(base)
              })
            else
              e.preventDefault();
        })
    });

    function mostrar_error(message){
        $.toast({
            heading: 'Error',
            text: message,
            showHideTransition: 'slide',
            icon:'error',
            position: 'top-right'
        })
    }

    @if(isset($local))
      $( document ).ready(function() {
        logo = $('#logo').croppie({
          viewport: { width: 200, height: 200, type: 'circle' },
          boundary: { width: 300, height: 300 },
          result: { circle: false, type: 'canvas' }
        });
        $("#logo-container").css('display', 'block');
      })
    @endif
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logo').attr('src', e.target.result);
                if(logo != undefined)
                  $("#logo").croppie('destroy');

                $("#logo-container").css('display', 'block')
                logo = $('#logo').croppie({
                  viewport: { width: 200, height: 200, type: 'circle' },
                  boundary: { width: 300, height: 300 },
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
