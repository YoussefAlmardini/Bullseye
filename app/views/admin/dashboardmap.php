<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<link rel="stylesheet" type="text/css" href="/src/styles/admin_map.css">
<?php

  if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn'] && !$_SESSION['organisationLoggedIn']) {
    header("Location: /login");
  }

  function getTypesQuestions()
  {
    // THIS FUNCTION CHECKS FOR EXISTANCE OF THE BY THE USER INSERTED E-MAILADDRESS
    $query = 'SELECT * FROM `question_types`';
    $db = DB::connect();
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    for ($i = 0; $i < count($result); $i++) {
      echo '<option type="text" id="type' . $i . '" value="' . $result[$i]["type_id"] . '">' . $result[$i]["type"] . '</option>';
    }
  }

  function getCustomerID()
  {
    $query = 'SELECT customer_id FROM customers WHERE name = :user_name;';
    $db = DB::connect();
    $stmt = $db->prepare($query);
    $stmt->bindValue(':user_name', $_SESSION['user']['first_name']);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
      $result = $stmt->fetchAll();
      for ($i = 0; $i < count($result); $i++) {
        $customer_id = '';
        $customer_id = $result[$i]["customer_id"];
        return $customer_id;
      }
    } else{
      return 0;
    }
    
  }

  function getOrganisations()
  {
    $customer_id = getCustomerID();

    $query = 'SELECT * FROM organisations WHERE customer_id =' . $customer_id . '';
    $db = DB::connect();
    $stmt = $db->prepare($query);
    $stmt->execute();

  
    if($stmt->rowCount() > 0) {
      $result = $stmt->fetchAll();
      for ($i = 0; $i < count($result); $i++) {
        $organisation_id = $result[$i]['organisation_id'];
        $organisation_name = $result[$i]['name'];
        echo '<option type="text" id="organisation' . $i . '" value="' . $organisation_id . '">' . $organisation_name . '</option>';
      }
      return $organisation_id;
    } else{
      echo '<a>Geen organisaties</a>';
    }
    
  }


  function getMaps()
  {
    $customer_id = getCustomerID();
    $organisation_id = getCustomerID();

    $query = 'SELECT * FROM expeditions
      INNER JOIN customers
      WHERE expeditions.organisation_id = ' . $organisation_id . ' AND customers.customer_id = ' . $customer_id . '';
    $db = DB::connect();
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    for ($i = 0; $i < count($result); $i++) {
      $expedition_id = $result[$i]['expedition_id'];
      $expedition_name = $result[$i]['2'];
      echo '<option name="expedition_id type="number" id="expedition_id' . $i . '" value="' . $expedition_id . '">' . $expedition_name . '</option>';
    }
  }


?>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<html>

<body>
  <div id="sideNav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/admin/profiel">Uw profiel</a>
    <a href="/admin/registeradmin">Admin aanmaken</a>
    <a href="/admin/addCustomer">Klant aanmaken</a>
    <a href="/admin/addOrganisation">Organisatie aanmaken</a>
    <a href="/admin/addContact">Contact aanmaken</a>
    <a href="/admin/generateHeatmap">Heatmap</a>
    <form method="POST" action="/home/logout">
      <a><input id="uitlog" type="submit" value="Uitloggen" name="logout"></a>
    </form>

  </div>
  <span id="navOpenButton" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

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
          <input type="text" name="info" id="info" value="" placeholder="Extra info">
          <input type="number" name="levels" id="levels" value="" placeholder="Level" required>
          <input type="number" name="setlatitude" id="setlatitude" value="" placeholder="Coordinaten latitude" readonly>
          <input type="number" name="setlongitude" id="setlongitude" value="" placeholder="Coordinaten longitude" readonly>
          <input type="number" hidden name="expedition_id" id="expedition_id">
          <button type="button" onclick="NewMap()"> Nieuwe map/Aanpassen</button>
          <button type="button" onclick="clearMap()">Opnieuw instellen</button>
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
        <input type="text" id="title_markers" value="" name="title" placeholder="Opdracht title*" required>
        <input type="number" id="queue_markers" value="" name="queue" placeholder="Volgorde vraag*" required>
        <select id="type_id" name="type_id" required>
          <option type="text" id="type" value="" selected disabled>Type selecteren</option>
          <?php echo getTypesQuestions(); ?>
        </select>
        <input type="text" id="answer" value="" name="answer" placeholder="Antwoord vraag*" required>
        <input type="text" id="tip1" value="" name="tip1" placeholder="Tip 1*" required>
        <input type="text" id="tip2" value="" name="tip2" placeholder="Tip 2">
        <input type="text" id="guide_next" value="" name="guide_next" placeholder="Gids naar volgende vraag">
        <input type="number" id="latitude" value="" name="latitude" placeholder="Coordinaten Latitude*" readonly required>
        <input type="number" id="longitude" value="" name="longitude" placeholder="Coordinaten Longitude*" readonly required>
        <button type="button" onclick="addData()" id="">Nieuwe marker/Aanpassen</button>
        <button type="button" onclick="resetFields()">Opniew instellen vraag</button>
        <button type="button" onclick="clearAll()">Alles opnieuw instellen</button>
      </form>
    </ul>
  </div>
  <div id="mymap"></div>
  </div>
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

</html>