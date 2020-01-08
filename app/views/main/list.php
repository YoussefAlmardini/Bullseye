<?php
    include "app/views/header/index.php";
?>

<body>
    <div class="thirdTitle spaceUnder center">
        Current speurtocht
    </div>

    <div class="scaverageList">

        <?php 
            $result = Model\Main::GetExpeditions();

            for($i = 0; $i < count($result); $i++) {

                $id = $result[$i]['id'];
                $ex_name = $result[$i]['expedition_name'];
                $organisation = $result[$i]['organistion'];
                $location = $result[$i]['location'];
                $info = $result[$i]['info'];
                $level = $result[$i]['level'];

                echo " <div class='scaverageItem'>
           
                <div class='scaverageItemIcon'>
                    <img src='/src/assets/zoo.png'>
                </div>
    
                <div class='scaverageItemTitle'>
                    $ex_name
                </div>
    
                <div class='IconInfo'>
                    <div class='infoBlock tooltip'>
                        <span class='tooltiptext'>Locatie</span>
                        <div class='icon'><img src='/src/assets/locationIcon.png'></div>
                        <div class='infoBockData'>$location</div>
                    </div>
                    <div class='infoBlock tooltip'>
                        <span class='tooltiptext'>Totaal punten</span>
                        <div  class='icon'><img src='/src/assets/Icon material-grade@2x.png'></div>
                        <div class='infoBockData'>$level punten</div>
                    </div>
                    <div class='infoBlock tooltip'>
                        <span class='tooltiptext'>Organisatie</span>
                        <div  class='icon'><img src='/src/assets/Icon metro-organization@2x.png'></div>
                        <div class='infoBockData'>$organisation</div>
                    </div>
                </div>
    
                <div class='scaverageItemTitle spaceUnder centerText'>
                    Wat gaan we doen?
              </div>

              <div class='text spaceUnder centerText'>
                  $info
              </div>
              
    
                <div class='scaverageItemButton'>   
                    <button class='green'>Start</button>
                </div>
    
            </div>";
            }
        ?>

       

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