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
                <?php echo "Dierentuin Amersfoort" ?>
            </div>

            <div class="IconInfo">
                <div class="infoBlock tooltip">
                    <span class="tooltiptext">Locatie</span>
                    <div class="icon"><img src="/src/assets/locationIcon.png"></div>
                    <div class="infoBockData"><?php echo "Amersfoort";?></div>
                </div>
                <div class="infoBlock tooltip">
                    <span class="tooltiptext">Datum</span>
                    <div  class="icon"><img src="/src/assets/dateIcon.png"></div>
                    <div class="infoBockData"><?php echo "02/02/2020";?></div>
                </div>
                <div class="infoBlock tooltip">
                    <span class="tooltiptext">Tijd</span>
                    <div  class="icon"><img src="/src/assets/timeIcon.png"></div>
                    <div class="infoBockData"><?php echo "13:00-22:00";?></div>
                </div>
            </div>

            <div class="scaverageItemTitle spaceUnder centerText">
                Wat gaan we doen?
          </div>

          <div class="text spaceUnder centerText">
                Er zijn vele variaties van passages van 
                Lorem Ipsum beschikbaar maar het merendeel 
                heeft te lijden gehad van wijzigingen
                 in een of andere vorm.
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