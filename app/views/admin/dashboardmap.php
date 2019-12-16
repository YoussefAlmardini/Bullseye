<?php
include "header.php";
?>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>   
<html>

<body>
<div id="mapwrap">
  <div id="toolbar">
    <div class="hamburger">
      <span>Admin</span>
    </div>
    <div id="tourstops">
      <h2>Nieuwe map creeren</h2>
      <ul>
          <h4>Map info</h4>
         <input type="number" id="Setlatitude" value="" placeholder="Coordinaten latitude" readonly>
         <input type="number" id="Setlongitude" value="" placeholder="Coordinaten longitude" readonly>

         <input type="text" id="title" value="" placeholder="Title marker" >
         <input type="text" id="descriptie" value="" placeholder="Descriptie" >

         <button type="submit" id="" onclick="NewMap()"> Voeg nieuwe map toe met de markers</button>
      </ul>
    </div>
  </div>
  <div id="mymap"></div>
</div>
<!-- Always as last loaded  --> 
</body>
<script>
  <?php
  include "js/admin_functions.js";
  ?>
</script>

</html>
