<?php
// include "header.php";
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/settings.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/bottomNavigation.css">
    </head>

    <body onload="BotBarNavigation.LoadPage();">

        <h1>settings</h1>
        <?php include "../app/components/bottomNavigation/index.php"; ?>
        <script>
            BotBarNavigation.SwitchActivaty('settings');
        </script>
    </body>
    
</html>