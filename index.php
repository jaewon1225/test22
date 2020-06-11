<!DOCTYPE html>
<html>
  <head>
    <style>
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map"></div>
    <script>
// Initialize and add the map
function initMap() {
  // The location of silla
  var silla = {lat: 35.16825697799745, lng: 128.99625354800833};
  //35.16825697799745, 128.99625354800833
  // The map, centered at silla
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: silla});
  // The marker, positioned at silla
  

  var myIcon = new google.maps.MarkerImage("./dz.png", null, null, null, new google.maps.Size(12,20));

  var marker = new google.maps.Marker({position: silla, map: map, icon: myIcon});

}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWhEEOK1BOOXj6y6bwR8D-nVH1hixvNtg&callback=initMap">
    </script>
  </body>
</html>


