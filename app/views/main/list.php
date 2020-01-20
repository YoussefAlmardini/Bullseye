<link rel="stylesheet" type="text/css" href="/src/styles/generalStyles.css">
<link rel="stylesheet" type="text/css" href="/src/styles/main.css">
<link rel="stylesheet" type="text/css" href="/src/styles/list.css">
<link rel="stylesheet" type="text/css" href="/src/styles/profiel.css">
<link rel="stylesheet" type="text/css" href="/src/styles/bottomNavigation.css">
<body>
    <div class="thirdTitle spaceUnder center">
        Alle speurtochten
    </div>

    <div class="scaverageList">

        <?php 

            //var_dump($_SESSION['user']['level_id'] > 0);
            var_dump($_SESSION['user']);
            if (!$_SESSION['user']) {
                header("Location: /login");
            }

            $query = 'SELECT *,`organisations`.`name` as `organisation`,`expeditions`.`name` as `expedition` FROM `expeditions` INNER JOIN `organisations` ON `organisations`.`organisation_id` = `expeditions`.`organisation_id`';
            $db = \DB::connect();
            $stmt = $db->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return [];
            }

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            for($i = 0; $i < count($result); $i++) {
                
                $id = $result[$i]['expedition_id'];
                $ex_name = $result[$i]['expedition'];
                $organisation = $result[$i]['organisation'];
                $location = $result[$i]['location_name'];
                $info = $result[$i]['description'];
                $level = $result[$i]['levels'];

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
                        <span class='tooltiptext'>Aantal levels</span>
                        <div  class='icon'><img src='/src/assets/Icon material-grade@2x.png'></div>
                        <div class='infoBockData'>$level levels</div>
                    </div>
                    <div class='infoBlock tooltip'>
                        <span class='tooltiptext'>Organisatie</span>
                        <div  class='icon'><img src='/src/assets/Icon metro-organization@2x.png'></div>
                        <div class='infoBockData'>$organisation</div>
                    </div>
                </div>
    
                <div class='scaverageItemTitle spaceUnder centerText'>
                    Omschrijving:
              </div>

              <div class='text spaceUnder centerText'>
                  $info
              </div>
              
    
                <div class='scaverageItemButton'>   
                    <form method='post' action='index.php' name=''>
                        <input class='green' type='submit' name='' id='$id' onclick='changeValue(this)' value='Start'>
                        <input type='text' name='id' value='$id' hidden>
                    <form>
                </div>
    
            </div>";
            }
        ?>

       

    </div>

      
    <?php include "app/components/bottomNavigation/index.php"; ?>
    <script>
        function changeValue(e) {
            var button = document.getElementById(e.id);
            var input = button.nextSibling.nextSibling;
            button.setAttribute("name", "clickedExpedition");
            input.setAttribute("name", "clickedID");
        }

        document.getElementById('list').style.background = "#0F7EC7";

        function ShowInfo(){
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
        }
    </script>
</body>
    
</html>