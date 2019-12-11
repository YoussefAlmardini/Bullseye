<?php
include "header.php";
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
         <input type="text" id="title" value="" placeholder="Title">
        <input type="text" id="descriptie" value="" placeholder="Descriptie">
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
