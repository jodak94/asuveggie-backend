<script type="text/javascript">
    $( document ).ready(function() {
      $('#solo_delivery').on('ifChecked', function(event){
        $("#map").hide()
      });
      $('#solo_delivery').on('ifUnchecked', function(event){
        $("#map").show()
      });
    });


    var map = L.map('map').setView([-25.29391, -57.61148], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    var marker = undefined;
    map.on('click', function(e) {
      $("#latitud").val(e.latlng.lat)
      $("#longitud").val(e.latlng.lng)
      if (marker != undefined)
          map.removeLayer(marker);
      marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
    });
</script>
