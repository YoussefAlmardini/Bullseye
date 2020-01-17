<html>
<head>
  <link rel="stylesheet" type="text/css" href="src/styles/generalStyles.css">
  <link rel="stylesheet" type="text/css" href="src/styles/home.css">
  <script src="/src/js/mobility.js"></script>
</head>

  <body>

    <div class="viewContainer viewContainerCustom">

        <div class="topBlock">

            <div class="Title spaceUnder">
                NLRangers
            </div>

            <div class="notification">

            </div>

        </div>

        

        <div class="secondTitle titleBlockTop">
              Welkom
        </div>

        <div class="home">

          <div class="thirdTitle spaceUnder">
                Wat is de NLRangers Web-App?
          </div>

          <div class="text spaceUnder">
                NLRangers is een web-app waar je speurtochten mee kan doen. Hartstikke leuk als familie uitje of wanneer je er zin in hebt.
          </div>

          <div class="thirdTitle spaceUnder">
                Zin in een speurtocht?
          </div>

          <div class="text spaceUnder">
                U kunt zich gratis aanmelden en volledig gebruik maken van de app. 
          </div>
          <hr>


         <div>
           <a href="/login/index">
            <button class="lightGreen">Inloggen</button>
           </a>
         </div>
         
         <div>
            <button onclick="ShowInfo(this)">
              <div class="popup" onclick="myFunction()">
                <label>Info</label>
                <span class="popuptext" id="myPopup">
                  Er zijn vele variaties van passages van 
                  Lorem Ipsum beschikbaar maar het merendeel 
                  heeft te lijden gehad van wijzigingen
                  in een of andere vorm.
                </span>
              </div>
            </button>
        </div>

        </div>

    </div>
    
  </body>

  <script>

    function ShowInfo(){
      var popup = document.getElementById("myPopup");
      popup.classList.toggle("show");
    }
  </script>

</body>

</html>
