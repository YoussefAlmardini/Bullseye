<head>
   <link rel="stylesheet" href="/src/styles/map.css"/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
   <script src="/src/js/questions.js"></script>
   <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
   <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>    
</head>
<body>
    <div class="TopDataBar" style='display:none;'>
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
</div><!-- Do not remove this DIV, this will end a DIV with class 'scaverage on index.php  -->
    <div id="mymap"></div>
</body>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script>

let currentPos = {
    latitude : 0,
    longitude : 0
}
var position;

document.getElementById('mymap').innerHTML = "<div id='map' style='width: 100%; height: 90%;'></div>";
const mymap = L.map('mymap').setView([52.1637739, 5.3965879], 15);    
// Default Layer Options
var layerOptions = {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 21,
    minZoom: 15,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibW9sbGllbmF0b3IiLCJhIjoiY2szdHp3eWtxMDUzNjNwazRrYWxxejBieSJ9.DdHVpF9UpzeZCWDWHgKeBg'
}

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', layerOptions).addTo(mymap);

// Sets icon
var myIcon = L.icon({
    iconUrl: window.location.origin + '/src/assets/myicon.png',
    iconSize: [50, 50],
    iconAnchor: [25, 50],
    popupAnchor: [],
});

// Your location marker
const mymarker = L.marker([0,0],
    {draggable: false,          // Make the icon dragable
    icon: myIcon,               // Adds own icon
    opacity: 1,                 // Adjust the opacity
    clickable: true,            // Make the icon clickable
    alt: 'mymarker'}            // Name for accessibillity
).addTo(mymap);

// Button to jump to your own location
L.easyButton('<span class="bigdot">&bigodot;</span>', function(){
    mymap.setView(mymarker.getLatLng(), 20);
}).addTo(mymap);

mymap.locate({ setView:true, watch: true });
mymap.on('locationfound', onLocationFound);
mymap.on('locationerror', function(e){
        //alert("Locatie toegang geweigerd.");
});

function success(position){
    updateLocation(position.coords.latitude, position.coords.longitude);
}

function geo_error() {
  alert("Sorry, no position available.");
}

var geo_options = {
  enableHighAccuracy: true,  
  timeout           : 3000
};

if (navigator.geolocation) navigator.geolocation.getCurrentPosition(success, geo_error, geo_options);

function updateLocation(latitude,longitude){
    position = [latitude,longitude];
}

function manageLocationFound(){
    mymarker.setLatLng(position)

    var promise = getYourCurrentQuestionLocation();
    console.log(promise);
    let data = null;
    promise.then(function(res) {
        var quest = res.quest;
        var id = res.questionID;
        var langitude = res.coordinate_langitude;
        var longitude = res.coordinate_longitude;
        // This is the distance between the current position of the marker and the center of the circle
        var distance = mymap.distance(position, [langitude,longitude]);
        // The marker is inside the circle when the distance is inferior to the radius
        var isInside = distance < 15;
        
        //If circle already exists, it will be deleted before making new circle
        if (typeof nextQuestionCircle !== 'undefined') {
            mymap.removeLayer(nextQuestionCircle);
        }
        nextQuestionCircle = new L.circle([langitude,longitude], {   
            color: "black", //Border color
            fillColor: "green", //Inside color
            fillOpacity: 0.5,
            radius: 15
        }).addTo(mymap);    
        if(isInside) {
            if(!document.getElementById('questionElement')) {
                currentQuestion = ShowQuestionDialog(quest, id, langitude, longitude);
                currentQuestion.Print();
            }
        } else{
            if(document.getElementById('questionElement')) {
                currentQuestion = ShowQuestionDialog(quest, id, langitude, longitude);
                currentQuestion.Delete();
            }
              
        }
    });//END PROMISE
}//End Manage Location Found

function onLocationFound(e) 
{
    if(mymap.hasLayer(mymarker)){
      manageLocationFound();
        
    } else {
        mymarker.addTo(mymap);
    }
}

function getYourCurrentQuestionLocation(){
    return fetch('/main/getYourQuestion/')
    .then(response => response.json());
}

function ShowQuestionDialog(question,id,lang,long){
    //This data comming from the database
    let coords = {
        lang:lang,
        long:long
    }
    let currentQuestion = new Question(question,'text');
    currentQuestion.CreateQuestionElement();
  
    function sendLocation(){
        var latitude = mymarker.getLatLng().lat;
        var longitude = mymarker.getLatLng().lng;

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
            }
        };
        xhttp.open("GET", "https://nlrangers.test/ajax/getLocation?latitude=" + latitude + "&longitude=" + longitude, true);
        xhttp.send();
    };

    (window.setInterval(sendLocation, 60000));
    return currentQuestion;
}

function sendAnswer() {
    var answer =  document.getElementById('answer').value;
    if(answer !=  '') {
        fetch('/main/sendAnswer/', {
            method: 'POST',
            body: JSON.stringify({
                answer: answer,
            })
        }).then(function(res) {
            return res.json();
        }).then(function(res) {
            if(res) {
                alert('Correct!');
                currentQuestion.Delete();
                
                navigator.geolocation.watchPosition(success, geo_error, geo_options);
                manageLocationFound();
            } else {
                alert('Uw antwoord is niet correct, helaas!');
            }
        })
    }else{
        alert('Vul een antwoord in');
    }
    
}
</script>
</body>
<?php 

// if(isset($_POST['answer'])){
//     $userAnswer = $_POST['answerBody'];
//     if( $userAnswer ===  '') {
//         echo "<script>alert('vul je aantwoord in');</script>";
//     }else{
//         $questionAnswerd = MainModel::validateUserAnswer($userAnswer);

//         if($questionAnswerd){
//             echo '<script>currentQuestion.Delete();</script>';
//             MainModel::getYourCurrentQuestion();
//         }else{
//             echo "<script>alert('het aantwoord is niet waar helaas!');</script>";
//         }
//     }
// }
// ?>
        
</html>
