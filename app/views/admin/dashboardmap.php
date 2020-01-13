<?php
include "header.php";
if (!$_SESSION['adminLoggedIn']) {
  header("Location: /admin/index");
}
$getOrganisations = false;
?>
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>   
<html>

<body>
<div id="sideNav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/admin/profiel">profiel</a>
    <a href="/admin/registeradmin">profielen aanmaken</a>
    <a href="#">Heatmap</a>

</div>
<span  id="navOpenButton" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<div id="mapwrap">
  <div id="toolbar">
    <div class="hamburger">
      <span>Mappen</span>
    </div>
      <h2>Nieuwe map</h2>
      <ul>
        <form id="newmapForm">
          <h4>Map info</h4>
          <!-- Een nieuwe map toevoegen -->
          <select id="organisation_id" name="organisation_id">
              <option type="text" id="organisation" value="" selected disabled>Organisatie selecteren</option>  
              <?php echo getOrganisations(); ?>
            </select>
          <input type="text" name="title_expedition" id="title_expedition" value="" placeholder="Titel speurtocht *" required>
          <input type="textarea" name="description" id="description" value="" placeholder="Omschrijving speurtocht *" required>
          <input type="text" name="loc_expedition" id="loc_expedition" value="" placeholder="Plaats *" required>
          <input type="text" name="info" id="Info" value="" placeholder="Extra info">
          <input type="number" name="setlatitude" id="setlatitude" value="" placeholder="Coordinaten latitude" readonly>
          <input type="number" name="setlongitude" id="setlongitude" value="" placeholder="Coordinaten longitude" readonly>
         <button type="button" onclick="NewMap()"> Voeg nieuwe map toe</button>
        </form>
      </ul>
    </div>
  </div>
  <div id="toolbar">
    <div class="hamburger hamburger2">
      <span>Markers</span>
    </div>
      <h2>Nieuwe markers</h2>
      <ul>
          <form id="markerForm">
            <h4>Marker info toevoegen</h4>
            <!-- Begin marker adding new map or choose organisation and add extra markers-->
            <select id='select_expedition' name="expedition_id">
                <option type="text" id="speurtocht" value="" selected disabled>Speurtocht selecteren</option>
                <?php echo getMaps(); ?>
            </select>
            <input type="number" value="" id="quest_id" name="id" hidden>         
            <input type="text" id="title_markers" value="" name="title" placeholder="Opdracht title*" required >
            <input type="number" id="queue_markers" value="" name="queue" placeholder="Volgorde vraag*" required >
            <select id="type_id" name="type_id" required>
              <option type="text" id="type" value="" selected disabled>Type selecteren</option>
              <?php echo getTypesQuestions(); ?>
            </select>
            <input type="text" id="answer" value="" name="answer" placeholder="Antwoord vraag*" required>
            <input type="text" id="tip1" value="" name="tip1" placeholder="Tip 1*" required>
            <input type="text" id="tip2" value="" name="tip2" placeholder="Tip 2" >
            <input type="number" id="latitude" value="" name="latitude" placeholder="Latitude*" readonly required>
            <input type="number" id="longitude" value="" name="longitude" placeholder="Longitude*" readonly required>
            <button type="button" onclick="addData()" id="">Add/Update</button>
            <button type="button" onclick="resetFields()">Reset</button>
            <button type="button" onclick="clearAll()">Clear All</button>
          </form>
      </ul>
  </div>
  <div id="mymap"></div>
</div>
<!-- Always as last loaded  --> 
</body>
<script>
  <?php
  include "js/admin_functions.js";
  ?>


  function openNav() {
        document.getElementById("sideNav").style.width = "250px";
        document.getElementById("navOpenButton").style.zIndex = "0";
  }

  function closeNav() {
        document.getElementById("sideNav").style.width = "0";
        document.getElementById("navOpenButton").style.zIndex = "1";
  }
  
</script>
<?php

function getTypesQuestions(){
  // THIS FUNCTION CHECKS FOR EXISTANCE OF THE BY THE USER INSERTED E-MAILADDRESS
  $query = 'SELECT * FROM `question_types`';
  $db = DB::connect();
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();
  for($i = 0; $i < count($result); $i++) {
    echo '<option type="text" id="type'.$i.'" value="'.$result[$i]["type_id"].'">'.$result[$i]["type"].'</option>';
  }
}

function getMaps(){
    $query = 'SELECT * FROM `expeditions`';
    $db = DB::connect();
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    for($i = 0; $i < count($result); $i++) {
      $expedition_id = $result[$i]['expedition_id'];
      $expedition_name = $result[$i]['name'];
      echo '<option name="expedition_id type="number" id="expedition'.$i.'" value="'.$expedition_id.'">'.$expedition_name.'</option>';
    }
}

function getOrganisations(){
  $query = 'SELECT * FROM `organisations`';
  $db = DB::connect();
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();
  for($i = 0; $i < count($result); $i++) {
    $organisation_id = $result[$i]['organisation_id'];
    $organisation_name = $result[$i]['name'];
    echo '<option type="text" id="organisation'.$i.'" value="'.$organisation_id.'">'.$organisation_name.'</option>';
  }
}


?>
</html>