<script type="text/javascript">
    @if(isset($local))
      var horariosCounter = {{count($local->horarios)}};
    @else
      var horariosCounter = 1;
    @endif
    var horarioHtml =''
    +'<div class="col-md-2" style="padding-right: 0;">'
    +'  <select name="dia_inicio[]" class="form-control">'
        @foreach ($dias as $key => $dia)
          +'<option @if($key == 0) selected @endif value={{$dia}}>{{$dia}}</option>'
        @endforeach
    +  '</select>'
    +'</div>'
    +'<div class="col-md-1 no-padding center mid-text">a</div>'
    +'<div class="col-md-2 no-padding center">'
    +  '<select name="dia_fin[]" class="form-control">'
        @foreach ($dias as $key => $dia)
    +      '<option @if($key == 6) selected @endif value={{$dia}}>{{$dia}}</option>'
        @endforeach
    +  '</select>'
    +'</div>'
    +'<div class="col-md-1 no-padding center mid-text">de</div>'
    +'<div class="col-md-2 no-padding center">'
    +  '<input name="hora_inicio[]" type="text" id="hora_inicio" class="time form-control" value="18:00">'
    +'</div>'
    +'<div class="col-md-1 no-padding center mid-text">a</div>'
    +'<div class="col-md-2 no-padding center">'
    +  '<input name="hora_fin[]" type="text" id="hora_inicio" class="time form-control" value="23:30">'
    +'</div>'
    +'    <div class="col-md-1">'
    +'      <button type="button" class="btn btn-danger btn-flat delete-button"><i class="fa fa-trash"></i></button>'
    +'    </div>'
    +'</div>'

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
            @if(!isset($local))
              if(logo == undefined){
                mostrar_error("El logo es obligatorio")
                ok = false;
              }
            @endif
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

        $("#buscar-ciudad").autocomplete({
          source: '{{route('admin.ciudades.ciudad.search_ajax')}}',
          select: function( event, ui){
            $("#ciudad_id").val(ui.item.id)
          }
        })

        /*----------Horarios----------*/
        $('.time').pickatime({
          clear: '',
          format: 'HH:i',
          interval: 30
        })

        $("#add-horario-button").on('click', function(){
          var html = ''
          +'<div id="h-'+horariosCounter+'" class="row margin-bottom">' + horarioHtml
          $("#horarios-container").append(html)
          $('.time').pickatime({
            clear: '',
            format: 'HH:i',
            interval: 30
          })
        })

        $('#horarios-container').on('click','.delete-button',function(){
          let dom = $(this).parent().parent();
          $(dom).remove()
        })
        /*----------------------------*/
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
        $("#edit-logo-button").on('click', function(){
          logo = $('#logo').croppie({
            viewport: { width: 200, height: 200, type: 'circle' },
            boundary: { width: 300, height: 300 },
            result: { circle: false, type: 'canvas' }
          });
          $("#editar_logo").val(1);
          $("#input-file-container").css('display', 'block');

        })
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
