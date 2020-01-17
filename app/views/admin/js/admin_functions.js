document.getElementById('mymap').innerHTML = "<div id='map' style='width: 100%; height: 90%;'></div>";
const mymap = L.map('mymap').setView([52.1637739, 5.3965879], 15);
var layerOptions = {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    minZoom: 10,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoibW9sbGllbmF0b3IiLCJhIjoiY2szdHp3eWtxMDUzNjNwazRrYWxxejBieSJ9.DdHVpF9UpzeZCWDWHgKeBg',

}

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', layerOptions).addTo(mymap);

L.Control.MyControl = L.Control.extend({
    onAdd: function(map) {
      var el = L.DomUtil.create('div', 'leaflet-bar my-control');
  
      el.innerHTML = 'Mijn mappen <img src="/src/assets/mapLocation.png"> Mijn locatie <img src="/src/assets/myicon.png"> Opgeslagen locatie <img src="/src/assets/InLocation.png"> Niet opgeslagen locatie <img src="/src/assets/ringNoLocation.png">';
       
      return el;
    },
  
    onRemove: function(map) {
      // Nothing to do here
    }
  });
  
  L.control.myControl = function(opts) {
    return new L.Control.MyControl(opts);
  }
  
  L.control.myControl({
    position: 'topright'
  }).addTo(mymap);


// Make a group where all the markers will in be
var group = L.featureGroup();  
mymap.addLayer(group);

// Sets icon
var myIcon = L.icon({
    iconUrl: window.location.origin + '/src/assets/myicon.png',
    iconSize: [20, 30],
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




// Put new input inbetween the two comments
$('#toolbar .hamburger').on('click', function() {
    $(this).parent().toggleClass('open');
    });
    
document.getElementById('mymap').style.cursor = 'crosshair';

// Make a marker where you click
mymap.on('dblclick', addMarker);
// End new inputs
mymap.locate({ setView:true, watch: true });
mymap.on('click', LoadClickedLocation);
mymap.on('locationfound', onLocationFound);

mymap.on('locationerror', function(e){
        alert("Locatie toegang geweigerd.");
});


//If an expedition is selected, get all the questions
document.getElementById('select_expedition').addEventListener('change', function(e) {
    group.clearLayers();
    const id = e.target.selectedOptions[0].value;

    fetch('/admin/api/' + id, {
        id: id,
    }).then(function(res) {
        return res.json();
    }).then(function(res) {
        for(const i in res) {
            const marker = res[i];

            const text = "<strong id='title'>"+marker.quest+"</strong><br>"+
            "<a hidden id='type_id_"+i+"'>"+marker.type_id+"</a><br>"+
            "Vraag:<a id='queue"+i+"'>"+marker.queue+"</a><br>"+
            "Antwoord:<a id='answer"+i+"'>"+marker.answer+"</a><br>"+
            "Tip 1:<a id='tip1_"+i+"'>"+marker.tips[0]+"</a><br>"+
            "Tip 2:<a id='tip2_"+i+"'>"+marker.tips[1]+"</a><br>";
            

            newCircle = new L.circle(L.latLng(marker.cordinates.lat, marker.cordinates.lng), {
                clickable: true,
                radius: 15,
                title: marker.quest,
                color: 'green',
                answer: marker.answer,
                queue: marker.queue,
                tip_1: marker.tips[0],
                tip_2: marker.tips[1],
                type_id: marker.type_id,
                id: marker.id,
                latitude: marker.cordinates.lat,
                longitude: marker.cordinates.lng

            }).addTo(group)
            .bindPopup(text)
            .openPopup()
            .on('contextmenu', deleteQuest)
            .on("click", circleClick)
            .on('mouseover', function (e) {
                this.openPopup();
            })
            .on('mouseout', function (e) {
                this.closePopup();
            });
        }
    })
});

function LoadClickedLocation(e){
    let Getlatitude = e.latlng.lat;
    document.getElementById("setlatitude").value = Getlatitude;
    document.getElementById('latitude').value = Getlatitude;

    let Getlongitude = e.latlng.lng;
    document.getElementById("setlongitude").value = Getlongitude ;
    document.getElementById('longitude').value = Getlongitude;
    }

function onLocationFound(e) 
{
    if(mymap.hasLayer(mymarker)){
        mymarker.setLatLng(e.latlng);
    } else {
        mymarker.addTo(mymap);
    }
    
}

function NewMap(e){
    Getlatitude = document.getElementById("Setlatitude").value;
    Getlongitude = document.getElementById("Setlongitude").value;

    mymap.setView(new L.LatLng(Getlatitude, Getlongitude));
}

function addMarker(e){
    // Add marker to map at click location; add popup window
    let title = document.getElementById("title_markers").value;
    const type_id = document.getElementById('type_id').selectedIndex;
    const queue = document.getElementById('queue_markers').value;
    const answer = document.getElementById('answer').value;
    const tip1 = document.getElementById('tip1').value;
    const tip2 = document.getElementById('tip2').value;
    const latitude = document.getElementById('latitude').value;
    const longitude = document.getElementById('longitude').value;
    const text = "<strong id='title'>"+title+"</strong><br>"+
            "<a hidden id='type_id'>"+type_id+"</a><br>"+
            "Vraag:<a id='queue'>"+queue+"</a><br>"+
            "Antwoord:<a id='answer'>"+answer+"</a><br>"+
            "Tip 1:<a id='tip1'>"+tip1+"</a><br>"+
            "Tip 2:<a id='tip2'>"+tip2+"</a><br>";
    newCircle = new L.circle(e.latlng, {
        clickable: true,
        radius: 15,
        title: title,
        answer: answer,
        queue: queue,
        tip_1: tip1,
        tip_2: tip2,
        type_id: type_id,
        id: "",
        latitude: latitude,
        longitude: longitude
    }).addTo(group)
    .bindPopup(text)
    .openPopup()
    .on('contextmenu', delete_marker)
    .on("click", circleClick)
    .on('mouseover', function (e) {
        this.openPopup();
    })
    .on('mouseout', function (e) {
        this.closePopup();
    });
};  

function delete_marker(e){
    mymap.removeLayer(this);
}

function circleClick(e){
    document.getElementById('title_markers').value = this.options.title;
    document.getElementById('queue_markers').value = this.options.queue;
    document.getElementById('answer').value = this.options.answer;
    document.getElementById('tip1').value = this.options.tip_1;
    document.getElementById('tip2').value = this.options.tip_2;
    document.getElementById('type_id').selectedIndex = this.options.type_id;
    document.getElementById('quest_id').value = this.options.id;
    document.getElementById('latitude').value = this.options.latitude;
    document.getElementById('longitude').value = this.options.longitude;
}

var serializeArray = function (form) {

	// Setup our serialized data
	var serialized = [];

	// Loop through each field in the form
	for (var i = 0; i < form.elements.length; i++) {

		var field = form.elements[i];

		// Don't serialize fields without a name, submits, buttons, file and reset inputs, and disabled fields
		if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') continue;

		// If a multi-select, get all selections
		if (field.type === 'select-multiple') {
			for (var n = 0; n < field.options.length; n++) {
                if (!field.options[n].selected) continue;
                const name = field.name
				serialized.push({
					name: field.name,
					value: field.options[n].value
				});
			}
		}

		// Convert field data to a query string
		else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
			serialized.push({
				name: field.name,
				value: field.value
			});
		}
	}

	return serialized;

};
function objectifyForm(form) {//serialize data function
    var formArray = serializeArray(form);
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
      returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
  }

function resetFields() {
    var selectedValue = document.getElementById('select_expedition').selectedIndex;
    document.getElementById('markerForm').reset();
    document.getElementById('select_expedition').selectedIndex = selectedValue;
    
}

function clearAll() {
    document.getElementById('markerForm').reset();
    group.clearLayers();
}

// Update or Inserting a marker
function addData() {
    const data = objectifyForm(document.getElementById('markerForm'));
    fetch('/admin/updateMarker/', {
        method: 'POST',
        body: JSON.stringify({
            id: data.id,
            expedition_id: data.expedition_id,
            type_id: data.type_id,
            title: data.title,
            answer: data.answer,
            queue: data.queue,
            tip1: data.tip1,
            tip2: data.tip2,
            latitude: data.latitude,
            longitude: data.longitude
        })
    }).then(function(res) {
        return res.json();
    }).then(function(res) {
        if(res) {
            alert('Marker geupdated of toegevoegd')
            location.reload();
        } else {
            alert('Er heeft een probleem plaatsgevonden, probeer het later nog eens');
        }
    })
}

function deleteQuest(e) {
    var r = confirm("Weet u zeker dat u de vraag wilt verwijderen?");
    if (r == true) {
        const data = objectifyForm(document.getElementById('markerForm'));
        fetch('/admin/deleteQuest/', {
            method: 'POST',
            body: JSON.stringify({
                id: data.id
            })
        }).then(function(res) {
            return res.json();
        }).then(function(res) {
            if(res) {
                alert('Vraag is succesvol verwijderd!');
                location.reload();
            } else {
                alert('Er heeft een probleem plaatsgevonden, probeer het later nog eens');
            }
        })
    } else {
        // PRESSED CANCEL
    }  
}

function NewMap(){
    const data = objectifyForm(document.getElementById('newmapForm'));
    
    let organisationValue = document.getElementById('organisation_id').selectedIndex;
    organisationID = document.getElementById('organisation_id').selectedIndex = organisationValue;


    fetch('/admin/newMap/', {
        method: 'POST',
        body: JSON.stringify({
            expedition_id: data.expedition_id,
            id:organisationValue,
            title: data.title_expedition,
            description: data.description,
            info: data.info,
            loc_expedition: data.loc_expedition,
            latitude: data.setlatitude,
            longitude: data.setlongitude,
            levels: data.levels
        })
    }).then(function(res) {
        return res.json();
    }).then(function(res) {
        if(res) {
            alert('Map is succesvol toegevoegd of aangepast!');
            location.reload();
        } else {
            alert('Er heeft een probleem plaatsgevonden, probeer het later nog eens');
        }
    })
}


function deleteMap(e) {
    var r = confirm("Weet u zeker dat u de map wilt verwijderen?");
    if (r == true) {
        const data = objectifyForm(document.getElementById('newmapForm'));


        fetch('/admin/deleteMap/', {
            method: 'POST',
            body: JSON.stringify({
                expedition_id: data.expedition_id
            })
        }).then(function(res) {
            return res.json();
        }).then(function(res) {
            if(res) {
                alert('Map is succesvol verwijderd, samen met eventuele markers!');
                location.reload();
            } else {
                alert('Er heeft een probleem plaatsgevonden, probeer het later nog eens');
            }
        })
    } else {
        // PRESSED CANCEL
    }  
}

function clearMap() {
    document.getElementById('newmapForm').reset();
    groupMaps.clearLayers();
}

// Make a group where all the markers will in be
var groupMaps = L.featureGroup();  
mymap.addLayer(groupMaps);

function mapClick(e){
    document.getElementById('title_expedition').value = this.options.nameMap;
    document.getElementById('description').value = this.options.description;
    document.getElementById('loc_expedition').value = this.options.name;
    document.getElementById('info').value = this.options.info;
    document.getElementById('levels').value = this.options.levels;
    document.getElementById('setlatitude').value = this.options.latitude;
    document.getElementById('setlongitude').value = this.options.longitude;
    document.getElementById('expedition_id').value = this.options.expedition_id;
}

//If an organisation is selected, get all the maps
document.getElementById('organisation_id').addEventListener('change', function(e) {
    groupMaps.clearLayers();
    const id = e.target.selectedOptions[0].value;

    fetch('/admin/getMaps/' + id, {
        id: id,
    }).then(function(res) {
        return res.json();
    }).then(function(res) {
        for(const i in res) {
            const maps = res[i];

            const text = "<strong id='title'>"+maps.nameMap+"</strong><br>"+   
            "<a id='description"+i+"'>"+maps.description+"</a><br>"+
            "<a hidden id='expedition_id"+i+"'>"+maps.expedition_id+"</a><br>"+
            "Locatie:<a id='loc_expedition"+i+"'>"+maps.name+"</a><br>"+
            "Extra info:<a id='extra"+i+"'>"+maps.info+"</a><br>"+
            "Level:<a id='levels"+i+"'>"+maps.levels+"</a><br>";

            newMarker = new L.marker(L.latLng(maps.cordinates.lat, maps.cordinates.lng), {
                clickable: true,
                nameMap: maps.nameMap,
                expedition_id:maps.expedition_id,
                description: maps.description,
                name:maps.name,
                info:maps.info,
                levels: maps.levels,
                latitude: maps.cordinates.lat,
                longitude: maps.cordinates.lng
            }).addTo(groupMaps)
            .bindPopup(text)
            .openPopup()
            .on('contextmenu', deleteMap)
            .on("click", mapClick)
            .on('mouseover', function (e) {
                this.openPopup();
            })
            .on('mouseout', function (e) {
                this.closePopup();
            });
        }
    })
});