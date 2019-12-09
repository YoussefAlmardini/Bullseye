<head>
    <link rel="stylesheet" href="../src/styles/map.css"/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
</head>
   
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin="">
    </script>

    <script> 
    function getMap(){
    document.getElementById('mymap').innerHTML = "<div id='map' style='width: 100%; height: 90%;'></div>";
    let XcM = document.getElementById("XcoordinateM").value;
    let YcM = document.getElementById("YcoordinateM").value;

    var mymap = L.map('mymap').setView(['0', '0'], 20);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        accessToken: 'pk.eyJ1IjoibW9sbGllbmF0b3IiLCJhIjoiY2szdHp3eWtxMDUzNjNwazRrYWxxejBieSJ9.DdHVpF9UpzeZCWDWHgKeBg'
    }).addTo(mymap);

            if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            latit = position.coords.latitude;
            longit = position.coords.longitude;
            // this is just a marker placed in that position
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(mymap);
            // move the map to have the location in its center
            mymap.panTo(new L.LatLng(latit, longit));
        })

    }

    function getCoordinates() {
    var mymap = L.map('mymap');
   
    let Xc = document.getElementById("Xcoordinate").value;
    let Yc = document.getElementById("Ycoordinate").value;
    let PopupMessage = document.getElementById("PopupMessage").value;

    console.log(Xc);
    console.log(Yc);

    var marker = L.marker([Xc, Yc]).addTo(mymap);
    marker.bindPopup(PopupMessage).openPopup();
    }
}

   
    </script>