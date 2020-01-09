let currentPos = {
    latitude : 0,
    longitude : 0
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(UpdateCurrentPosition);
} else { 
    alert('wa wa wa');
}

function UpdateCurrentPosition(position) {
    currentPos.latitude = position.coords.latitude;
    currentPos.longitude = position.coords.longitude;
}

console.log(currentPos);


document.getElementById('mymap').innerHTML = "<div id='map' style='width: 100%; height: 90%;'></div>";
const mymap = L.map('mymap').on('load', MapLoaded);

// Sets icon
var myIcon = L.icon({
    iconUrl: window.location.origin + '/src/assets/myicon.png',
    iconSize: [50, 50],
    popupAnchor: [],
});

L.marker([50.5, 30.5]).addTo(mymap);

// Your location marker
const mymarker = L.marker([0,0],
    {draggable: false,          // Make the icon dragable
    icon: myIcon,               // Adds own icon
    opacity: 1,                 // Adjust the opacity
    clickable: true,            // Make the icon clickable
    alt: 'mymarker'}            // Name for accessibillity
);



mymap.locate({ setView:true, watch: true });
mymap.on('locationfound', onLocationFound);
mymap.on('locationerror', function(e){
        //alert("Locatie toegang geweigerd.");
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

var id, target, options;

function success(pos) {
var crd = pos.coords;

if (target.latitude === crd.latitude && target.longitude === crd.longitude) {
    console.log('Congratulations, you reached the target');
    navigator.geolocation.clearWatch(id);
}
}

function error(err) {
console.warn('ERROR(' + err.code + '): ' + err.message);
}

target = {
    latitude : 0,
    longitude: 0
};


options = {
enableHighAccuracy: false,
timeout: 5000,
maximumAge: 0
};

id = navigator.geolocation.watchPosition(success, error, options);



function MapLoaded(){

        mymap.setView([currentPos.latitude,currentPos.longitude], 20);
        var layerOptions = {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        minZoom: 10,
        id: 'mapbox/streets-v11',
        accessToken: 'pk.eyJ1IjoibW9sbGllbmF0b3IiLCJhIjoiY2szdHp3eWtxMDUzNjNwazRrYWxxejBieSJ9.DdHVpF9UpzeZCWDWHgKeBg'
        }
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', layerOptions).addTo(mymap);

        console.log('map succeful loaded!');
        L.circle([currentPos.latitude,currentPos.longitude], {   
            color: "red",
            fillColor: "#f03",
            fillOpacity: 0.5,
            radius: 20
    }).addTo(mymap);
    L.easyButton('<span class="bigdot">&bigodot;</span>', function(){
    
        mymap.setView(mymarker.getLatLng(), 18);
    }).addTo(mymap);

}

    
    




//document.getElementById('mymap').addEventListener('click',ShowQuestionDialog);
