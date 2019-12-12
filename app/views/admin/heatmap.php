<?php
    if(!$_SESSION['adminLoggedIn']){
        header("Location: /admin/index");
    }

    require_once("header.php");
?>

<html lang="en">
    <head>
        <script src="leaflet-heatmap.js"></script>
        <title>Heatmap - Admin | NL Rangers</title>
    </head>

    <body>
        <h1>Welkom op de heatmap-pagina</h1>

        <script>
            var heat = L.heatLayer([
                [50.5, 30.5, 0.2], // lat, lng, intensity
                [50.6, 30.4, 0.5],
                ...
            ], {radius: 25}).addTo(map);
        </script>
    </body>
</html>