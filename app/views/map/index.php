<?php
// include "header.php";
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/map.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/bottomNavigation.css">
    </head>

    <body>

        <div id="mymap"></div>
        <input type="number" id="XcoordinateM" placeholder="X Coordinate Map" value="52.1844862">
        <input type="number" id="YcoordinateM" placeholder="Y Coordinate Map" value="5.4061271">
        <input type="button" onclick="getMap()" value="Laad map">

        <input type="number" id="Xcoordinate" placeholder="X Coordinate Marker">
        <input type="number" id="Ycoordinate" placeholder="Y Coordinate Marker">
        <input type="text" id="PopupMessage" placeholder="Popup bericht">
        <input type="button" onclick="getCoordinates()" value="Set a marker">
    </body>
    
</html>


    <!-- Always as last loaded  -->
<?php
include "mapload.php";
?>

