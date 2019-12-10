<head>
    <link rel="stylesheet" href="../src/styles/map.css"/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
</head>
<body>
<div id="mymap"></div>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

<script> 
    document.getElementById('mymap').innerHTML = "<div id='map' style='width: 100%; height: 90%;'></div>";
    var mymap = L.map('mymap').setView([52.1637739, 5.3965879], 20);
    mymap.setZoom(15);

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
        // If user denies use of location
        }, function() {
            alert('Uw locatie is nodig om aan een speurtocht te beginnen');
        });
    }
</script>
</body>