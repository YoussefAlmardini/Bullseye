<?php
    include "../app/views/header/index.php";
?>

<html>
    <head></head>
<body>


<div class="scaverage">
   

</div>
    <?php 
        $empty = false;
        $list = false;
        $main = true;

        if($empty){ include 'emptyMain.php';}
        else if($list){include 'scaverageList.php';}
        else if ($main){ include "map.php";}
    ?>



<?php include "../app/components/bottomNavigation/index.php"; ?>
<script>
    BotBarNavigation.SwitchActivaty('main');
</script>
</body>



</html>
