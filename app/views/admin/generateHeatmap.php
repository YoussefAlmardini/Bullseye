<?php
if (!$_SESSION['organisationLoggedIn']) {
    header("Location: /login");
}
?>

<html lang="en">
    <head>
        <title>Genereer heatmap - Admin | NL Rangers</title>
        <link rel="stylesheet" type="text/css" href="../src/styles/admin_heatmap.css">
    </head>

    <body>
        <div id="sideNav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="/admin/map">Speurtocht aanmaken</a>
            <a href="/admin/profiel">Uw Profiel</a>
            <a href="/admin/registeradmin">Profiel aanmaken</a>
            <a href="/admin/addCustomer">Klant aanmaken</a>
            <a href="/admin/addOrganisation">Organisatie aanmaken</a>
            <a href="/admin/addContact">Contact aanmaken</a>
            <form method="POST">
                <a><input id="uitlog" type="submit" value="Uitloggen" name="logout"></a>
            </form>
        </div>

        <span  id="navOpenButton" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

        <h1>Welkom op de heatmap-pagina</h1>

        <form method="POST" action="/admin/initHeatmapPeriod">
            <legend>Selecteer informatie om een heatmap te laten genereren:</legend><br>
            <input type="hidden" name="organisation_id" value="<?php echo $_SESSION['organisation_id'] ?>">

            <label for="starting_date">Begindatum: </label>
            <input type="date" name="starting_date"><br><br>

            <label for="end_date">Einddatum: </label>
            <input type="date" name="end_date"><br><br>
            
            <input type="submit" name="submit" value="Genereer heatmap">
        </form>
    </body>
    <script>
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