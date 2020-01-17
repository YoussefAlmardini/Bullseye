<link rel="stylesheet" type="text/css" href="/src/styles/main.css">
<link rel="stylesheet" type="text/css" href="/src/styles/bottomNavigation.css">
<body>
    <div class="scaverage">
    <?php 
   
    if (!$_SESSION['user']) {
        header("Location: /login");
    }

    if(isset($_POST['clickedID'])){
        include_once "map.php";
        $_SESSION['expedition_id'] = $_POST['clickedID'];
        //die('Dit is jouw ID: '. $_POST['clickedID']);
        $query = 'SELECT * FROM `quests` WHERE `expedition_id`='.$_POST['clickedID'];
        $db = \DB::connect();
        $stmt = $db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return [];
        }

        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $_SESSION['quests'] = array();
        
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


<?php include "app/components/bottomNavigation/index.php"; ?>
<script>
    document.getElementById('main').style.background = "#0F7EC7";
</script>
</body>



</html>
