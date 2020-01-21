<?php
    include "app/views/header/index.php";
?>

<body>


<div class="scaverage">
   <?php 
   
   if(isset($_POST['expStart'])){
        include_once "map.php";
        $query = 'SELECT * FROM `quests` WHERE `expedition_id`='.$_POST['id'].'';
        $db = \DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return [];
        }

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $_SESSION['quests'] = array();

        $query = 'SELECT organisation_id FROM expeditions WHERE expedition_id = :expedition_id;';
        $db = \DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':expedition_id', $_POST['id']);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        $_SESSION['organisationIDOfCurrentExpedition'] = $row->organisation_id;

        for($i = 0; $i < count($result); $i++) {
           $questionID = $result[$i]['quest_id'];
           $answer = $result[$i]['answer'];
           $quest = $result[$i]['quest'];
           $queue = $result[$i]['queue'];
           $coordinate_langitude = $result[$i]['coordinate_langitude'];
           $coordinate_longitude = $result[$i]['coordinate_longitude'];
           $dataRow = [
            'questionID' => $questionID,
            'answer' => $answer,
            'quest' => $quest,
            'queue' => $queue,
            'coordinate_langitude' =>  $coordinate_langitude,
            'coordinate_longitude' => $coordinate_longitude
           ];
           array_push($_SESSION['quests'],$dataRow);
         
        }
   }else{
    include_once "emptyMain.php"; 
   }
   ?>
</div>

<?php include "app/components/bottomNavigation/index.php"; ?>
<script>
    document.getElementById('main').style.background = "#0F7EC7";
</script>
</body>



</html>
