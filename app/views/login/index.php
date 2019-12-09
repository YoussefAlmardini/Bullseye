<html>
<head>
  <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
  <link rel="stylesheet" type="text/css" href="../src/styles/login.css">
</head>

  <body>
    <script>
    console.log("<?php echo $data['error_login']?>")
    </script>
    <div class="viewContainer viewContainerCustom">

      <div class="topBlock">

        <div class="Title">
            NLRangers
        </div>

        <div class="notification">

        </div>

      </div>

      <div class="middleBlock">

        <form method="post" action="/login/authorize">

        <div class="secondTitle formTitle">
          Inloggen
        </div>

         <div class="inputContainer">
            <input type="email" name="email" placeholder=""/>
         </div>

         <div class="inputContainer">
            <input type="password" name="password" placeholder=""/>
         </div>

          <div class="inputContainer">
            <button type="submit">Akkoord</button>
          </div>

        </form>

      </div>

      <div class="bottomBlock">

        <div class="secondTitle">Nog geen account?</div>
        <div class="link"><a href="/register">Account aanmaken</a></div>

      </div>


    </div>
    

  </body>
</html>
