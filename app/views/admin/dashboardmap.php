<?php
include "header.php";
include "../../models/Admin.php"
?>
<html>

<body>
<div id="mapwrap">
  <div id="toolbar">
    <div class="hamburger">
      <span>Dieren</span>
    </div>
    <div id="tourstops">
      <h2>Dieren</h2>
      <ul>
          <h4>Marker info</h4>
         <input type="text" id="title" value="" placeholder="Opdracht Title">
         <input type="text" id="descriptie" value="" placeholder="Opdracht Descriptie">
         <select>
              <option value="0">Selecteer een type voor deze vraag.</option>
        </select> 
         <button type="submit" id="add_to_map" onclick=""> Voeg locatie's toe aan map</button>
      </ul>
    </div>
  </div>
  <div id="mymap"></div>
</div>
    <!-- Always as last loaded  --> 
</body>
<?php
include "mapload.php";
?>


</html>
