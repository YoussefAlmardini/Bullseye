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

        customCircleMarker = L.CircleMarker.extend({
            options: { 
               title: 'Custom data!',
               type_id: 'Custom data!',
               queue: 'Custom data!',
               tip_1: 'Custom data!',
               tip_2: 'More data!'
            }
         });

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
            const id = e.target.selectedOptions[0].value;

            fetch('/admin/api/' + id, {
                id: id,
            }).then(function(res) {
                return res.json();
            }).then(function(res) {
                for(const i in res) {
                    const marker = res[i];

                    console.log(marker);
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
                        answer: marker.answer,
                        queue: marker.queue,
                        tip_1: marker.tips[0],
                        tip_2: marker.tips[1],
                        type_id: marker.type_id,
                        id: marker.id

                    }).addTo(mymap)
                    .bindPopup(text)
                    .openPopup()
                    .on('contextmenu', delete_marker)
                    .on("click", circleClick);
                }
            })
        });

        function LoadClickedLocation(e){
            let Getlatitude = e.latlng.lat;
            document.getElementById("Setlatitude").value = Getlatitude;

            let Getlongitude = e.latlng.lng;
            document.getElementById("Setlongitude").value = Getlongitude ;
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
            let bind_title_descriptie = "<strong>"+title+"</strong>" +"<br>";

            newCircle = new L.circle(e.latlng, {
                clickable: true,
                radius: 15,
            }).addTo(mymap)
            .bindPopup(bind_title_descriptie)
            .openPopup()
            .on('contextmenu', delete_marker);
        };  

        function delete_marker(e){
            mymap.removeLayer(this);
        }

        function circleClick(e){
            console.log(this.options);
            document.getElementById('title_markers').value = this.options.title;
            document.getElementById('queue_markers').value = this.options.queue;
            document.getElementById('answer').value = this.options.answer;
            document.getElementById('tip1').value = this.options.tip_1;
            document.getElementById('tip2').value = this.options.tip_2;
            document.getElementById('type_id').selectedIndex = this.options.type_id;
            document.getElementById('quest_id').value = this.options.id;

        }
