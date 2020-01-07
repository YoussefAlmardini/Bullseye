<?php
    include "app/views/header/index.php";
?>

<body>
    <div class="thirdTitle spaceUnder center">
        Current speurtocht
    </div>

    <div class="scaverageList">

        <div class="scaverageItem">
           

            <div class="scaverageItemIcon">
                <img src="/src/assets/zoo.png">
            </div>

            <div class="scaverageItemTitle">
                Card Title
            </div>

            <div class="scaverageItemButton">   
                <button class="green">Start</button>
            </div>

        </div>

    </div>

      
    <?php include "app/components/bottomNavigation/index.php"; ?>
    <script>

        document.getElementById('list').style.background = "#0F7EC7";

        function ShowInfo(){
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
        }
    </script>
</body>
    
</html>