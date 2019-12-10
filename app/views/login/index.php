<html>
<head>
  <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
  <link rel="stylesheet" type="text/css" href="../src/styles/login.css">
</head>

  <body>
    <div class="viewContainer viewContainerCustom">

      <div class="topBlock">

        <div class="Title">
            NLRANGERS
        </div>

        <div class="notification redNotification" 
        style="display:<?php echo( isset($_SESSION['errors']) ? 'block' : 'none')?>">
         <p  id="notification">
           <?php
            if(isset($_SESSION['errors']['unvalid_email'])){
              echo 'E-mailadres is niet geldig';
            }
            else if(isset($_SESSION['errors']['inc_username'])){
              echo 'E-mailadres is incorrect';
            }
            else if(isset($_SESSION['errors']['inc_password'])){
              echo 'Wachtwoord is incorrect';
            } 
            else if(isset($_SESSION['errors']['no_connection'])){
              echo 'Geen verbinding met database';
            }else{
              echo '';
            }
          ?>
         </p>
        </div>

      </div>

      <div class="middleBlock">

        <form method="post" action="/login/authorize">

        <div class="secondTitle formTitle">
          Inloggen
        </div>

         <div class="inputContainer">
            <input type="email" name="email" placeholder="e-mail"/>
         </div>

         <div class="inputContainer">
            <input type="password" name="password" placeholder="wachtwoord"/>
         </div>

          <div class="inputContainer">
            <button type="submit">Akkoord</button>
          </div>

        </form>

      </div>

      <div class="bottomBlock">

        <div class="secondTitle">Nog geen account?</div>
        <div class="link"><a href="/registration/index">Account aanmaken</a></div>

      </div>


    </div>
    

  </body>
</html>
