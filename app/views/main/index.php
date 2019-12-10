<?php
// include "header.php";
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/map.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/main.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/bottomNavigation.css">
    </head>
<body>

<div id="mymap"></div>

    <?php include "../app/components/bottomNavigation/index.php"; ?>
    <script>
        BotBarNavigation.SwitchActivaty('main');
    </script>

</body>
<?php
include "map.php";
?>


</html>
