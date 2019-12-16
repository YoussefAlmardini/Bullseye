<html>
<head>
  <link rel="stylesheet" type="text/css" href="src/styles/generalStyles.css">
  <link rel="stylesheet" type="text/css" href="src/styles/home.css">
</head>

  <body>

    <div class="viewContainer viewContainerCustom">

        <div class="topBlock">

            <div class="Title spaceUnder">
                NLRANGERS
            </div>

            <div class="notification">

            </div>

        </div>

        

        <div class="secondTitle titleBlockTop">
              Welcome
        </div>

        <div class="home">

          <div class="thirdTitle spaceUnder">
                Wat is NL Rangers App?
          </div>

          <div class="text spaceUnder">
                Er zijn vele variaties van passages van 
                Lorem Ipsum beschikbaar maar het merendeel 
                heeft te lijden gehad van wijzigingen
                 in een of andere vorm.
          </div>

          <div class="thirdTitle spaceUnder">
                Zin in enn speurtocht?
          </div>

          <div class="text spaceUnder">
                Er zijn vele variaties van passages van 
                Lorem Ipsum beschikbaar maar het merendeel 
                heeft te lijden gehad van wijzigingen
                 in een of andere vorm.
          </div>
          <hr>


         <div>
           <a href="/login/index">
            <button class="lightGreen">Inloggen</button>
           </a>
         </div>
         
         <div>
            <button onclick="ShowInfo(this)">
              <div class="popup" onclick="myFunction()">Info
                <span class="popuptext" id="myPopup">
                  <p>Info</p>
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
