<head>
    <link rel="stylesheet" href="../src/styles/map.css"/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
</head>
<body>
    <div class="TopDataBar">

    <div class="TopDataMain" id="level">
        <p>Level</p>
    </div>

    <div class="TopDataMain TopDataMainMiddle" id="location">
        <p>Locatie</p>
    </div>

    <div class="TopDataMain" id="time">
        <p>Tijd</p>
    </div>

    </div>
<div id="mymap">
  
</div>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
<script> 
    document.getElementById('mymap').innerHTML = "<div id='map' style='width: 100%; height: 90%;'></div>";
    const mymap = L.map('mymap').setView([52.1637739, 5.3965879], 15);
    var layerOptions = {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        minZoom: 10,
        id: 'mapbox/streets-v11',
        accessToken: 'pk.eyJ1IjoibW9sbGllbmF0b3IiLCJhIjoiY2szdHp3eWtxMDUzNjNwazRrYWxxejBieSJ9.DdHVpF9UpzeZCWDWHgKeBg'
    }
    
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', layerOptions).addTo(mymap);

    // Sets icon
    var myIcon = L.icon({
        iconUrl: window.location.origin + '/src/assets/myicon.png',
        iconSize: [50, 50],
        popupAnchor: [],
    });

    // Your location marker
    const mymarker = L.marker([0,0],
        {draggable: false,          // Make the icon dragable
        icon: myIcon,               // Adds own icon
        opacity: 1,                 // Adjust the opacity
        clickable: true,            // Make the icon clickable
        alt: 'mymarker'}            // Name for accessibillity
    );

    L.easyButton('<span class="bigdot">&bigodot;</span>', function(){
        mymap.setView(mymarker.getLatLng(), 18);
    }).addTo(mymap);
    
    mymap.locate({ setView:true, watch: true });
    mymap.on('locationfound', onLocationFound);
    
    mymap.on('locationerror', function(e){
            alert("Locatie toegang geweigerd.");
    });

    function onLocationFound(e) 
    {
        if(mymap.hasLayer(mymarker)){
            mymarker.setLatLng(e.latlng);
            console.log(e.latitude);
        } else {
            mymarker.addTo(mymap);
        }
        
    }
</script>
</body>