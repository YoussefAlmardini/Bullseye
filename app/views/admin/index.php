<?php
include "header.php";
?>
<html>

<body>
    <!-- <div id="mymap"></div> -->

    <!-- Always as last loaded  -->
    
    <form action="/login/authorizeAdmin" method="POST">
        <input required type="email" placeholder="E-mailadres" name="email">
        <input required type="password" placeholder="Wachtwoord" name="password">
        <input required type="submit" placeholder="Inloggen" name="submit">
    </form>
</body>
<?php
//include "mapload.php";
?>


</html>
