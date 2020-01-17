<link rel="stylesheet" type="text/css" href="/src/styles/generalStyles.css">
<link rel="stylesheet" type="text/css" href="/src/styles/profiel.css">
<link rel="stylesheet" type="text/css" href="/src/styles/bottomNavigation.css">
<link rel="stylesheet" type="text/css" href="/src/styles/home.css">
<script src="/src/js/mobility.js"></script>
    <body>
        <div class="viewContainer viewContainerCustom">

            <div class="topBlock">
                <br><br><br>
                <div class="secondTitle formTitle">
                    Profiel
                </div>
            </div>

            <div class="middleBlock">


                <form class="formprofiel" action="/profiel/UpdateAccount" method="POST">
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
                        <label class="birthdatetitle" for="birthDate">Level: </label>
                        <input class="level" required type="text" placeholder="Level *" disabled id="level" readonly name="level">

                    </div>


                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Geboortedatum: </label>
                        <input class="birthdate" required type="date" id="birthdate" name="birthdate">

                    </div>


                    <div class="submitContainer">
                        <button type="submit">Verzenden</button>
                    </div>

                </form>

            </div>
    </div>

    <?php include "app/components/bottomNavigation/index.php"; ?>
    <script>
        document.getElementById('profile').style.background = "#0F7EC7";
    </script>
</body>
</html>

<script>

    document.getElementById('firstname').value = "<?php echo $data['user']['first_name']; ?>";
    document.getElementById('insertion').value = "<?php echo $data['user']['insertion']; ?>";
    document.getElementById('lastname').value = "<?php echo $data['user']['last_name']; ?>";
    document.getElementById('email').value = "<?php echo $data['user']['email_address']; ?>";
    document.getElementById('level').value = "<?php echo $data['user']['level']; ?>";
    document.getElementById('birthdate').value = "<?php echo $data['user']['birthdate']; ?>";



    function Edit(e) {
        let targetInput = e.parentElement.children[1];
        let targetImage = e.parentElement.children[2];

        if (targetInput.readOnly === true){
            targetInput.readOnly = false;
            targetImage.src = "src/assets/Icon-edit-selected.png"
        }else{
            targetInput.readOnly = true;
            targetImage.src = "src/assets/Icon-edit.png";
        }
    }
</script>