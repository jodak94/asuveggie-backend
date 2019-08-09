<script type="text/javascript">
    $( document ).ready(function() {
      $('#solo_delivery').on('ifChecked', function(event){
        $("#map").hide()
      });
      $('#solo_delivery').on('ifUnchecked', function(event){
        $("#map").show()
      });
    });

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
</script>
