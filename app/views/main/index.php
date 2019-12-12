<?php
    include "../app/views/header/index.php";
?>

<html>
    <head></head>
<body>


<div class="scaverage">
    <div class="TopDataBar">

    <div class="TopDataMain" id="level">
        <p>Level</p>
    </div>

    <div class="TopDataMain TopDataMainMiddle" id="location">
        <p>Locatie</p>
    </div>

    <div class="TopDataMain" id="time">
        <p>Tijd</p>
    </div>

    </div>

    <div id="mymap"></div>

  

    <?php
    include "map.php";
    ?>
</div>

<?php include "../app/components/bottomNavigation/index.php"; ?>
<script>
    BotBarNavigation.SwitchActivaty('main');
</script>
</body>



</html>
