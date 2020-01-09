
<head>
   <link rel="stylesheet" href="/src/styles/map.css"/>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""/>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
   <script src="/src/js/questions.js"></script>

</head>
    <body>
        <script>
            function ShowQuestionDialog(){
                //This data comming from the database
                let question = 'hoeveel oplifanten zie je?';
                let currentQuestion = new Question(question,'text');
                currentQuestion.CreateQuestionElement();
                currentQuestion.Print();
            }

        
        </script>

        <?php
            if(isset($_POST['answer'])){
                $userAnswer = $_POST['answerBody'];
                if( $userAnswer ===  '') {
                    echo "<script>alert('nee nee nee');</script>";
                }else{
                    //Check from database if the answer is correct

                    $questionAnswerd = true;

                    if($questionAnswerd){
                        echo '<script>currentQuestion.Delete();</script>';
                    }
                }
            }
        ?>


        <div class="TopDataBar">

        <div class="TopDataMain" id="level">
            <p>Level</p>
            <p>level_data</p>
        </div>

        <div class="TopDataMain TopDataMainMiddle" id="location">
            <p>Locatie</p>
            <p>location_data</p>
        </div>

        <div class="TopDataMain" id="time">
            <p>Tijd</p>
            <p>time_date</p>
        </div>

        </div>
    <div id="mymap">
    
    </div>
  
</body>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
    <script>
  <?php
  include "js/leafletUserMap.js";
  ?>
  </script>
</html>
