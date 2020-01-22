<?php
if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn'] && !$_SESSION['organisationLoggedIn']) {
    header("Location: /admin/map");
}
?>


<link rel="stylesheet" href="../src/styles/admin_profiel.css"/>
<body>
<div id="sideNav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="/admin/map">Speurtocht maken</a>
    <a href="/admin/registeradmin">Profielen aanmaken</a>
    <a href="/admin/addCustomer">Klant aanmaken</a>
    <a href="/admin/addOrganisation">Organisatie aanmaken</a>
    <a href="/admin/addContact">Contact aanmaken</a>
    <a href="/admin/generateHeatmap">Heatmap</a>
    <form method="POST">
        <a><input id="uitlog" type="submit" value="Uitloggen" name="logout"></a>
    </form>
</div>
<span  id="navOpenButton" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<div class="viewContainer viewContainerCustom">

    <div class="topBlock">
        <br><br><br>

    </div>

    <div class="middleBlock">


        <form class="formprofiel" action="/admin/UpdateAdminAccount" method="POST">
            <div class="topimage"></div>
            <img class="profielimage" src="../src/assets/Icon-user.png">

            <div class="inputContainer marginset">
                <label class="birthdatetitle" for="birthDate">Voornaam: </label>
                <input class="firstname" required type="text" placeholder="Voornaam *" value="" id="firstname" name="firstName">

            </div>

            <div class="inputContainer">
                <label class="birthdatetitle" for="birthDate">Tussenvoegsel: </label>
                <input class="insertion" type="text" placeholder="Tussenvoegsel" id="insertion" name="insertion">

            </div>

            <div class="inputContainer">
                <label class="birthdatetitle" for="birthDate">Achternaam: </label>
                <input class="lastname" required type="text" placeholder="Achternaam *" id="lastname"  name="lastName">


            </div>


            <div class="inputContainer">
                <label class="birthdatetitle" for="birthDate">E-mail: </label>
                <input class="email" required type="email" placeholder="E-mail *" disabled readonly id="email" readonly name="email">
                \
            </div>

            <div class="inputContainer">
                <label class="birthdatetitle" for="birthDate">Functie: </label>
                <input class="level" required type="text" placeholder="Function *" id="level"s name="function">

            </div>


            <div class="inputContainer">
                <label class="birthdatetitle" for="birthDate">Telefoon-nummer: </label>
                <input class="birthdate" required type="number" placeholder="" id="birthdate" name="phone_number">

            </div>


            <div class="submitContainer">
                <button type="submit">Verzenden</button>
            </div>

        </form>

    </div>
</div>

<script>
    document.getElementById('profile').style.background = "#0F7EC7";
</script>
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


    document.getElementById('firstname').value = "<?php echo $data['user']['first_name']; ?>";
    document.getElementById('insertion').value = "<?php echo $data['user']['insertion']; ?>";
    document.getElementById('lastname').value = "<?php echo $data['user']['last_name']; ?>";
    document.getElementById('email').value = "<?php echo $data['user']['email_address']; ?>";
    document.getElementById('level').value = "<?php echo $data['user']['function']; ?>";
    document.getElementById('birthdate').value = "<?php echo $data['user']['phone_number']; ?>";
</script>