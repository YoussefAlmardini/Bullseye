<head>
   <link rel="stylesheet" href="/src/styles/map.css"/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
   <script src="/src/js/questions.js"></script>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
   <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>    
</head>
<body>
    <div class="TopDataBar">
        <div class="TopDataMain" id="level">
            <p>Level</p>
            <p>level_data</p>
        </div>
        <div class="TopDataMain TopDataMainMiddle" id="location">
            <p>Locatie</p>
            <p>location_data</p>
        </div>
        <div class="TopDataMain" id="time">
            <p>Tijd</p>
            <p>time_date</p>
        </div>
    </div>
    <div id="mymap"></div>
</body>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script>
let currentPos = {
    latitude : 0,
    longitude : 0
}
document.getElementById('mymap').innerHTML = "<div id='map' style='width: 100%; height: 90%;'></div>";
const mymap = L.map('mymap').setView([52.1637739, 5.3965879], 15);    
// Default Layer Options
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
    iconSize: [20, 20],
    iconAnchor: [10, 20],
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

// Button to jump to your own location
L.easyButton('<span class="bigdot">&bigodot;</span>', function(){
    mymap.setView(mymarker.getLatLng(), 18);
}).addTo(mymap);

mymap.locate({ setView:true, watch: true });
mymap.on('locationfound', onLocationFound);
mymap.on('locationerror', function(e){
        //alert("Locatie toegang geweigerd.");
});

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(UpdateCurrentPosition);
} else { 
    alert('De website heeft uw locatie nodig om goed te functioneren.');
}

function UpdateCurrentPosition(position) {
    currentPos.latitude = position.coords.latitude;
    currentPos.longitude = position.coords.longitude;
}


function onLocationFound(e) 
{
    if(mymap.hasLayer(mymarker)){
        mymarker.setLatLng(e.latlng);
        // setTimeout(() => {
        //     L.circle([currentPos.latitude,currentPos.longitude], {   
        //         color: "red",
        //         fillColor: "blue",
        //         fillOpacity: 0.5,
        //         radius: 15
        //     }).addTo(mymap);
        // }, 0);
        getYourCurrentQuestionLocation();
        // This is the distance between the current position of the marker and the center of the circle
        var distance = mymap.distance(e.latlng, [52.1739999562361300,5.4037646949291240]);
        //circle.getLatLng()  
        // TODO: GET CURREN"T QUESTION CIRCLE DATA

        // The marker is inside the circle when the distance is inferior to the radius
        var isInside = distance < 15;
        //circle.getRadius() 
        // TODO: GET CURRENT QUESTION CIRCLE DATA

        if(isInside) {
            //alert('Ik zit erin');
        } else{
            //alert('NIET ERIN');
        }
    } else {
        mymarker.addTo(mymap);
    }
}

function getYourCurrentQuestionLocation(){
    fetch('/main/getYourQuestion/')
    .then(function(res) {
        return res.json();
    }).then(function(res) {
        console.log(res);
    })
}

function NavigateTargetQuestion(coords,currentQuestion){
    var id, target, options;
    function success(pos) {
        var crd = pos.coords;

        if (target.latitude === crd.latitude && target.longitude === crd.longitude) {
            console.log('Congratulations, you reached the target');
            currentQuestion.Print();
            navigator.geolocation.clearWatch(id);
        }
    }

    function error(err) {
        console.warn('ERROR(' + err.code + '): ' + err.message);
    }

    target = {
        latitude : coords.lang,
        longitude: coords.long
    };

    const circle = L.circle([target.latitude,target.longitude], {   
        color: "black",
        fillColor: "green",
        fillOpacity: 0.5,
        radius: 15
    }).addTo(mymap);

    options = {
    enableHighAccuracy: false,
    timeout: 5000,
    maximumAge: 0
    };

    id = navigator.geolocation.watchPosition(success, error, options);
}// END NavigateTargetQuestion()

function ShowQuestionDialog(question,id,lang,long){
    //This data comming from the database
    let coords = {
        lang:lang,
        long:long
    }
    let currentQuestion = new Question(question,'text');
    currentQuestion.CreateQuestionElement();
    NavigateTargetQuestion(coords,currentQuestion);
    
    //currentQuestion.Print();
}// END ShowQuestionDialog()

//window.onpaint = ShowQuestionDialog(question,id,lang,long);
</script>
<?php 

if(isset($_SESSION['quests'])){ 
    $question = $_SESSION['quests'][0]['quest'];
    $id =  $_SESSION['quests'][0]['questionID'];
    $lang = $_SESSION['quests'][0]['coordinate_langitude'];
    $long = $_SESSION['quests'][0]['coordinate_longitude'];
    echo "<script>ShowQuestionDialog('$question','$id','$lang','$long');</script>";
}

if(isset($_POST['answer'])){
    $userAnswer = $_POST['answerBody'];
    if( $userAnswer ===  '') {
        echo "<script>alert('nee nee nee');</script>";
    }else{
        //Check from database if the answer is correct

        $questionAnswerd = true;

        if($questionAnswerd){
            echo '<script>currentQuestion.Delete();</script>';
        }
    }
}
?>
        
</html>
