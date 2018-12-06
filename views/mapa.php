<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Call Center</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
<nav class="navbar navbar-light bg-light" id="agente">
  <a class="navbar-brand">
    <img src="img/call-center.png" width="30" height="30" class="d-inline-block align-top no-seleccionable" alt="">
    Call Center
  </a>
  <span class="navbar-text no-seleccionable" v-for='item in list' v-if="item.IdAgente == idAgente">
      {{item.Nombre}}
    </span>
  <a href="index.html" ><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cerrar sesión</button></a>
</nav>
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb no-seleccionable">
      <li class="breadcrumb-item" aria-current="page">Deudores</li>
      <li class="breadcrumb-item " aria-current="page">nombre del deudor</li>
      <li class="breadcrumb-item active " aria-current="page">Mapa</li>
    </ol>
</nav>
<div class="tabla-c">
<div class="pac-card" id="pac-card">
      <div>
        <div id="title">
          Buscador
        </div>
        <div id="type-selector" class="pac-controls">
          
        </div>
      </div>
      <div id="pac-container">
        <input id="pac-input" type="text"
            placeholder="Enter a location">
      </div>
    </div>
    <div id="map"></div>
    <div id="infowindow-content">
      <img src="" width="10" height="10" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>

    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 20.6122835, lng: -100.4115633},
          zoom: 13
        });
        marcadores(map);
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        
        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });
        
            
      }
      function marcadores (map){
          var beaches = [
          ['Calle Ezequiel Montes 3, Centro, 76000 Santiago de Querétaro, Qro.', 20.589991, -100.397402, 4],
          ['Acceso Carretera Celaya Cuota, Virreyes, 76175 Santiago de Querétaro, Qro.', 20.577359, -100.406544, 5],
          ['Av. 5 de Febrero 9846, Jurica, 76100 Santiago de Querétaro, Qro.', 20.651106, -100.432607, 3],
          ['Paseo de Libero 104, Manzanares, Juriquilla, Qro.', 20.707068, -100.443490, 2],
          ['Río Bravo 2001, colonia El Pocito, 76902 Santiago de Querétaro, Qro.', 20.557332, -100.418215, 1]
        ];
        var image = {
          url: 'img/flag.png',
          size: new google.maps.Size(50, 32),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(0, 32)
        };
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        for (var i = 0; i < beaches.length; i++) {
          var beach = beaches[i];
          var marker = new google.maps.Marker({
            position: {lat: beach[1], lng: beach[2]},
            map: map,
            icon: image,
            shape: shape,
            title: beach[0],
            zIndex: beach[3],
            content: beach[0]
          });
        }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtsRprziIxG4nRzFBixVhtkYVcJrb40Bo&libraries=places&callback=initMap"
        async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.5.1/vue-resource.min.js"></script>
<script>
var urlAgente='http://localhost:3003/agente';
new Vue({
  el: '#agente',
  created: function(){
    this.getAgente();
  },
  data:{
    list: [],
    idAgente: <?php echo $_GET["idA"];?>
  },
  methods: {
    getAgente: function(){
      this.$http.get(urlAgente).then(function(response){
        this.list = response.data;
      });
    }
  }
});
</script>
</div>
</body>
</html>