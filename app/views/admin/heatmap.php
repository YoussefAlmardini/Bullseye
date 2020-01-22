<?php
if (!$_SESSION['organisationLoggedIn']) {
    header("Location: /admin/map");
}
?>

<html lang="en">

<head>
    <title>Heatmap - Admin | NL Rangers</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../src/styles/admin_heatmap.css">
    <style>
        #map {
            height: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        var map;
        var coordinatesObj = <?php echo json_encode($data['locations']) ?>;
        var heatmapData = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 47.545699,
                    lng: 16.068600
                },
                zoom: 1
            });
            initHeatMap();
        }

        function initHeatMap() {
            for (i = 0; i < coordinatesObj.length; i++) {
                heatmapData.push(new google.maps.LatLng(coordinatesObj[i][0], coordinatesObj[i][1]));
            }

            var heatmap = new google.maps.visualization.HeatmapLayer({
                data: heatmapData
            });

            heatmap.setMap(map);
        }
    </script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvPT8O8uZWxxFVCXMf2JOBrzAA0aeyyho&libraries=visualization&callback=initMap"></script>
</body>

</html>