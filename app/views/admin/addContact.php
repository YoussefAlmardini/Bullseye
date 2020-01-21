<?php
if (!$_SESSION['adminLoggedIn']) {
    header("Location: /admin/index");
}

// require_once("header.php");
?>

<html lang="en">
<head>
    <title>Contact toevoegen | NL Rangers</title>
    <meta charset="utf-8">
</head>

<body>
<div id="sideNav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/admin/map">Speurtocht aanmaken</a>
    <a href="/admin/profiel">Uw Profiel</a>
    <a href="/admin/registeradmin">Profiel aanmaken</a>
    <a href="/admin/addCustomer">Klant aanmaken</a>
    <a href="/admin/addOrganisation">Organisatie aanmaken</a>
    <a href="/admin/generateHeatmap">Heatmap</a>
    <form method="POST">
        <a><input id="uitlog" type="submit" value="Uitloggen" name="logout"></a>
    </form>
</div>

<span  id="navOpenButton" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<form action="/admin/sendContactDataToModel" method="post">
    <label>Kies de klant waarvoor u een organisatie wil toevoegen:</label>
    <select name="customer">
        <option selected="selected" disabled>Kies een klant</option>
        <?php
        for($i = 0; $i < count($data['customers']); $i++){
            echo '<option>' . $data['customers'][$i] . '</option>';
        }
        ?>
    </select><br><br>

    <label>Voornaam</label><br>
    <input type="text" name="firstname" id="firstname"><br>

    <label>Tussenvoegsel: </label><br>
    <input type="text" name="insertion" id="insertion"><br>

    <label>Achternaam: </label><br>
    <input type="text" name="lastname" id="lastname"><br>

    <label>Functie: </label><br>
    <input type="text" name="function" id="function"><br>

    <label>E-mail: </label><br>
    <input type="text" name="email" id="email"><br>

    <label>Telefoon nummer: </label><br>
    <input type="text" name="phonenumber" id="phoneNumber"><br>

    <br><br><input type="submit" name="submit" value="Opslaan">
</form>

</body>
<script>
    function openNav() {
        document.getElementById("sideNav").style.width = "250px";
        document.getElementById("navOpenButton").style.zIndex = "0";
    }

    function closeNav() {
        document.getElementById("sideNav").style.width = "0";
        document.getElementById("navOpenButton").style.zIndex = "1";
    }
</script>
</html>