<?php
if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn'] && !$_SESSION['organisationLoggedIn']) {
    header("Location: /login");
}
?>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"
   integrity="sha512-A7vV8IFfih/D732iSSKi20u/ooOfj/AGehOKq0f4vLT1Zr2Y+RX7C+w8A1gaSasGtRUZpF/NZgzSAu4/Gc41Lg=="
   crossorigin=""></script>
   <script src="leaflet-heatmap.js"></script>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>    
<script> 
    $(document).ready(function () {

    document.getElementById('mymap').innerHTML = "<div id='map' style='width: 100%; height: 90%;'></div>";
    var mymap = L.map('mymap').setView([52.1637739, 5.3965879], 20);
    mymap.setZoom(15);

    new L.Control.Zoom({
    position: 'topright'
    }).addTo(mymap);

    // Default layer options
    var layerOptions = {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        minZoom: 10,
        id: 'mapbox/streets-v11',
        accessToken: 'pk.eyJ1IjoibW9sbGllbmF0b3IiLCJhIjoiY2szdHp3eWtxMDUzNjNwazRrYWxxejBieSJ9.DdHVpF9UpzeZCWDWHgKeBg'
    }



    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;

      //      window.setInterval(function(){
      //          var xhttp = new XMLHttpRequest();
      //          xhttp.open("POST", "../../controllers/anonymouslocation.php?latitude=" + latitude + "&longitude=" + longitude, true);
      //          xhttp.send();
      //      }, 60000);

            // Sets icon
            var myIcon = L.icon({
                iconUrl: window.location.origin + '/src/assets/myicon.png',
                iconSize: [30, 50],
                iconAnchor: [20,55],
                popupAnchor: [],
            });

            // Marker of your current location
            var marker = L.marker([position.coords.latitude, position.coords.longitude],
            {draggable: false,        // Make the icon dragable
            icon: myIcon,           // Adds own icon
            opacity: 1,            // Adjust the opacity
            clickable: true}         // Make the icon clickable
            ).addTo(mymap);
            // Move the map to your current location
            mymap.panTo(new L.LatLng(latitude, longitude));
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', layerOptions).addTo(mymap);

            // Make a marker where you click
            mymap.on('click', addMarker);

        // If user denies use of location
        }, function() {
            latitude = 52.15139964059902;
            longitude = 5.347382775621776;

            // Marker for location: Dierenpark Amersfoort
            var markerOptions = {
                title: "Dierenpark Amersfoort",
                clickable: true,
                draggable: false
            }
            var marker = L.marker([latitude, longitude],
            {draggable: true,        // Make the icon dragable
            title: 'Amersfoort',     // Add a title
            opacity: 1,              // Adjust the opacity
            clickable: true}         // Make the icon clickable
            ).addTo(mymap)
            .bindPopup("<b>Dierenpark Amersfoort</b><br>Hier is het begin van een speurtocht<br>.")
            .openPopup();
            
            // Move the map in the center of location
            mymap.panTo(new L.LatLng(latitude, longitude));
                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', layerOptions).addTo(mymap);
            });
            
            // Maak een nieuwe marker
            let newCircle = {};
            function addMarker(e){
            // Add marker to map at click location; add popup window
            let title = document.getElementById("title").value;
            
            const text = "<strong id=''>"+title+"</strong><br>"+
                    "<a hidden id='type_id_"+i+"'>"+marker.type_id+"</a><br>"+
                    "Vraag:<a id='queue"+i+"'>"+marker.queue+"</a><br>"+
                    "Antwoord:<a id='answer"+i+"'>"+marker.answer+"</a><br>"+
                    "Tip 1:<a id='tip1_"+i+"'>"+marker.tips[0]+"</a><br>"+
                    "Tip 2:<a id='tip2_"+i+"'>"+marker.tips[1]+"</a><br>";

            newCircle = new L.circle(e.latlng,
            {
            clickable: true,
            radius: 15,
            }
            ).addTo(mymap)
            .bindPopup(text)
            .openPopup()
            .on('contextmenu', delete_marker);
            };  

            function delete_marker(e){
                mymap.removeLayer(this);
            }

            $('#toolbar .hamburger').on('click', function() {
            $(this).parent().toggleClass('open');
            });

            function add_marker_map(){

            }
            
        

    }
});

</script>