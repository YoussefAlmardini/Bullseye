var position;
let currentPos = {
    latitude : 0,
    longitude : 0
}

// Define map (mymap is ID from div)
const mymap = L.map('mymap');    

// Default Layer Options
var layerOptions = {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 21,
    minZoom: 15,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibW9sbGllbmF0b3IiLCJhIjoiY2szdHp3eWtxMDUzNjNwazRrYWxxejBieSJ9.DdHVpF9UpzeZCWDWHgKeBg'
}

// Add layer to map
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
);

// Add and make button to jump to your location
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
//   alert("Sorry, no position available.");
}

var geo_options = {
  enableHighAccuracy: true,  
  timeout           : 2700
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
    // When there is no more queston (End of expedition) this catch will be called     
    }).catch(() => {
        alert('Jij bent klaar met je speurtocht! kier een andere speurtocht te doen!');
        let nextLocaton =  window.location.href.replace('index.php','list');
        location.replace(nextLocaton);
    });//End Promise
}//End Manage Location Found

function onLocationFound(e) 
{
    if(mymap.hasLayer(mymarker)){
        navigator.geolocation.getCurrentPosition(success, geo_error, geo_options);
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
    //This data coming from the database
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

//When user gives answer this function will be called
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