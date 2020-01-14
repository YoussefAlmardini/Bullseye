<head>
    <link rel="stylesheet" href="../src/styles/admin_map.css"/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

   
</head>
<body>
    <?php
        if(isset($_POST['logout'])){
            logoutUser();
        }

        function logoutUser(){
            $_SESSION = [];
            session_destroy();
            header("Location: /admin/index");
        }
    ?>
</body>