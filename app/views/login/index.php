<html>
<head>
  <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
  <link rel="stylesheet" type="text/css" href="../src/styles/login.css">
</head>

  <body>
    <script>
    console.log("<?php echo($data['test']['email_address'])?>")
    </script>
    <div class="viewContainer viewContainerCustom">

      <div class="topBlock">

        <div class="Title">
            NLRANGERS
        </div>

        <div class="notification">

        </div>

      </div>

      <div class="middleBlock">

        <form method="post" action="//TODO">

        <div class="secondTitle formTitle">
          Inloggin
        </div>

         <div class="inputContainer">
            <input type="email" placeholder="Email"/>
         </div>

         <div class="inputContainer">
            <input type="password" name="password" id="password" placeholder="wachtwoord"/>
             <input type="checkbox" onclick="showPassword()">Laat wachtwoord zien
         </div>

          <div class="inputContainer">
            <button type="submit">Akkord</button>
          </div>

        </form>

      </div>

      <div class="bottomBlock">

        <div class="secondTitle">Nog geen account?</div>
        <div class="link"><a href="#">Account aanmaken</a></div>

      </div>


    </div>
    

  </body>
</html>
<script>
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
