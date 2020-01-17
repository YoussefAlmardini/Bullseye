<?php
if (!$_SESSION['adminLoggedIn']) {
    header("Location: /login");
}
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
    <link rel="stylesheet" type="text/css" href="../src/styles/adminregister.css">
</head>

<body>
<div class="viewContainer viewContainerCustom">
    <div class="middleBlock">
        <div id="sideNav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="/admin/map">Speurtocht aanmaken</a>
            <a href="/admin/profiel">Uw Profiel</a>
            <a href="/admin/addCustomer">Klant aanmaken</a>
            <a href="/admin/addOrganisation">Organisatie aanmaken</a>
            <a href="/admin/addContact">Contact aanmaken</a>
            <a href="/admin/generateHeatmap">Heatmap</a>
            <form method="POST">
                <a><input id="uitlog" type="submit" value="Uitloggen" name="logout"></a>
            </form>
        </div>

        <span  id="navOpenButton" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <div class="secondTitle formTitle">
            Admin registreren
        </div>

        <form class="formregister" action="/admin/CreateNewAdmin" method="POST">


            <div class="inputContainer">
                <input required type="text" placeholder="Voornaam *" name="firstName">
            </div>
            <div class="inputContainer">
                <input type="text" placeholder="Tussenvoegsel" name="insertion">
            </div>
            <div class="inputContainer">
                <input required type="text" placeholder="Achternaam *" name="lastName">
            </div>
            <div class="inputContainer">
                <label class="birthdatetitle" for="birthDate">Geboortedatum: </label> <br><br>
                <input required type="date" name="birthDate">
            </div>

            <div class="inputContainer">
                <input required type="email" placeholder="E-mailadres *" name="email_address">
            </div>

            <div class="inputContainer">
                <input required type="password" placeholder="Wachtwoord *" id="password" name="password">
                <img class="passwordshow" id="passwordshowimage" src="../src/assets/Icon-eye.png" onclick="showPassword()">
            </div>

            <div class="inputContainer">
                <button required name="submit" onclick="changePasswordType(); changePasswordType2()" type="submit">Verzenden</button>
            </div>

        </form>

    </div>

    <div class="bottomBlock">

    </div>


</div>


</body>
</html>
<script>


    function openNav() {
        document.getElementById("sideNav").style.width = "250px";
        document.getElementById("navOpenButton").style.zIndex = "0";
    }

    function closeNav() {
        document.getElementById("sideNav").style.width = "0";
        document.getElementById("navOpenButton").style.zIndex = "1";
    }

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
    function showPassword2() {
        var x = document.getElementById("passwordrepeat");
        var img = document.getElementById("passwordshowimage2");
        if (x.type === "password") {
            x.type = "text";
            img.src = "../src/assets/Icon-eye-off.png";
            img.className = "passwordshow4";
        } else {
            x.type = "password";
            img.src = "../src/assets/Icon-eye.png";
            img.className = "passwordshow3";
        }
    }

    function changePasswordType2() {
        var x = document.getElementById("passwordrepeat");
        var img = document.getElementById("passwordshowimage2");
        if (x.type === "password") {

        } else {
            x.type = "password";
            img.src = "../src/assets/Icon-eye.png";
            img.className = "passwordshow3";
        }
    }
</script>