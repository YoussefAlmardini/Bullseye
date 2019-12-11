<?php
// include "header.php";
?>
<html>
    <head>
        <script src="src/js/accountNavigation.js"></script>
        <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/settings.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/bottomNavigation.css">
    </head>

    <body onload="BotBarNavigation.LoadPage();">

        <div class="settingsHeader">
            <h1>Instellingen</h1>
        </div>

        <div class="settingItemTitle">Speurtocht</div>
        <div class="settingsBox">

            <div class="settingsItem borderBottom">
                <div class="settingsItemLabel">History</div>
                <button class="lightGreen">></button>
            </div>

            <div class="settingsItem">
            <div class="settingsItemLabel">Gegevens mailen</div>
                <button class="lightGreen">></button>
            </div>

        </div>

        <div class="settingItemTitle"></div>
        <div class="settingItemTitle"></div>
        <div class="settingItemTitle">Account</div>
        <div class="settingsBox">

            <div class="settingsItem">
                <div class="settingsItemLabel">Log Out</div>
                <button>></button>
            </div>
        </div>

        
        <?php include "../app/components/bottomNavigation/index.php"; ?>
        <script>
            BotBarNavigation.SwitchActivaty('settings');
        </script>
    </body>
    
</html>