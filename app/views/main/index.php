<?php
    include "app/views/header/index.php";
?>

<body>


<div class="scaverage">
   <?php 
    //include_once "emptyMain.php"; 
    include_once "map.php";
   ?>
</div>

<?php include "app/components/bottomNavigation/index.php"; ?>
<script>
    document.getElementById('main').style.background = "#0F7EC7";
</script>
</body>



</html>
