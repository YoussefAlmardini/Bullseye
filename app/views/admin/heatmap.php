<?php
    if(!$_SESSION['adminLoggedIn']){
        header("Location: /admin/index");
    }

    require_once("header.php");
    // require_once("mapload.php");
?>

<html lang="en">
    <head>
        <title>Heatmap - Admin | NL Rangers</title>
    </head>

    <body>
        <h1>Uw heatmap wordt hier getoond:</h1>

        <?php
            $locationsArr = (array)$data['locations'];
            
            foreach($locationsArr as $row) {
                echo $row['latitude'] . '<br>';
            }
        ?>
        <!-- <script>
            var heat = L.heatLayer([
                [52.177908, 5.386823, 0.9], // lat, lng, intensity
            ], {radius: 25}).addTo(mymap);

            mymap.addLayer(heat);
        </script> -->
    </body>
</html>