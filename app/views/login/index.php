<html>

<head>
  <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
  <link rel="stylesheet" type="text/css" href="../src/styles/login.css">
</head>

<body>
  <div class="viewContainer viewContainerCustom">
    <div class="topBlock">
      <div class="Title">
        NLRangers
      </div>

      <div class="notification redNotification" style="display:<?php echo (isset($_SESSION['errors']) ? 'block' : 'none') ?>">
        <p id="notification">
          <?php
          if (isset($_SESSION['errors']['unvalid_email'])) {
            echo 'E-mailadres is niet geldig';
          } else if (isset($_SESSION['errors']['inc_username'])) {
            echo 'Inloggegevens zijn incorrect';
          } else if (isset($_SESSION['errors']['inc_password'])) {
            echo 'Inloggegevens zijn incorrect';
          } else if (isset($_SESSION['errors']['no_connection'])) {
            echo 'Geen verbinding met database';
          } else {
            echo '';
          }
          ?>
        </p>
      </div>
    </div>
    <div class="middleBlock">
      <form method="post" action="/login/authenticate">
        <div class="secondTitle formTitle">
          Inloggen
        </div>
        <div class="inputContainer">
          <input type="email" name="email" placeholder="E-mail" />
        </div>
        <div class="inputContainer">
          <input type="password" name="password" id="password" placeholder="Wachtwoord" />
          <img class="passwordshow" id="passwordshowimage" src="../src/assets/Icon-eye.png" onclick="showPassword()">
        </div>
        <div class="inputContainer">
          <button onclick="changePasswordType()" type="submit">Inloggen</button>
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
<script>
  function showPassword() {
    var x = document.getElementById("password");
    var img = document.getElementById("passwordshowimage");
    if (x.type === "password") {
      x.type = "text";
      img.src = "../src/assets/Icon-eye-off.png";
      img.className = "passwordshow2";
    } else {
      x.type = "password";
      img.src = "../src/assets/Icon-eye.png";
      img.className = "passwordshow";
    }
  }

  function changePasswordType() {
    var x = document.getElementById("password");
    var img = document.getElementById("passwordshowimage");
    if (x.type === "password") {

    } else {
      x.type = "password";
      img.src = "../src/assets/Icon-eye.png";
      img.className = "passwordshow";
    }
  }
</script>