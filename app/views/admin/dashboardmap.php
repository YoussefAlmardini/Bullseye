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
      <span>Mappen</span>
    </div>
    <div id="tourstops">
      <h2>Nieuwe map creeren</h2>
      <ul>
          <h4>Map info</h4>
          <!-- Een nieuwe map toevoegen -->
          <input type="text" id="title_speurtocht" value="" placeholder="Title speurtocht">
          <input type="text" id="description" value="" placeholder="Omschrijving speurtocht">
          <input type="text" id="Info" value="" placeholder="Extra info">
         <input type="number" id="Setlatitude" value="" placeholder="Coordinaten latitude" readonly>
         <input type="number" id="Setlongitude" value="" placeholder="Coordinaten longitude" readonly>
         <button type="submit" id="" onclick="NewMap()"> Voeg nieuwe map toe</button>

      </ul>
    </div>
  </div>
  <div id="toolbar">
    <div class="hamburger hamburger2">
      <span>Markers</span>
    </div>
    <div id="tourstops">
      <h2>Nieuwe markers creeren</h2>
      <ul>
          <h4>Marker info toevoegen</h4>
         <!-- Begin marker adding new map or choose organisation and add extra markers-->
          <select>
            <option type="text" id="Organisation" value="">Organisatie selecteren</option>
            <option type="text" id="Organisation" value="">Dierentuin</option>
          </select>
         <input type="text" id="title_markers" value="" placeholder="Opdracht title" >
         <input type="text" id="descriptie" value="" placeholder="Opdracht descriptie" >
         <select>
            <option type="text" id="" value="">Type selecteren</option>
            <option type="text" id="" value="">Open vraag</option>
            <option type="text" id="" value="">Meerkeuze</option>
          </select>
          <input type="text" id="tip1" value="" placeholder="Antwoord vraag" >
          <input type="text" id="tip1" value="" placeholder="Tip 1" >
          <input type="text" id="tip2" value="" placeholder="Tip 2" >
         <button type="submit" id="" onclick="NewMarkers()"> Voeg markers aan de map toe</button>
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
