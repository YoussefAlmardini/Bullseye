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

<script>
    <?php
        include "js/map.js";
    ?>
</script> 
</html>
