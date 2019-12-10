<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/profiel.css">
        <link rel="stylesheet" type="text/css" href="../src/styles/bottomNavigation.css">
    </head>

    <body>
        <div class="viewContainer viewContainerCustom">

            <div class="topBlock">

                <div class="secondTitle formTitle">
                    Profiel
                </div>
            </div>

            <div class="middleBlock">


                <form class="formprofiel" action="*" method="POST">
                    <div class="topimage"></div>
                    <img class="profielimage" src="../src/assets/Icon-user.png">

                    <div class="inputContainer marginset">
                        <label class="birthdatetitle" for="birthDate">voornaam: </label> <br><br>
                        <input required type="text" placeholder="Voornaam *" name="firstName">
                    </div>

                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Tussenvoegsel: </label> <br><br>
                        <input type="text" placeholder="Tussenvoegsel" name="insertion">
                    </div>

                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Achternaam: </label> <br><br>
                        <input required type="text" placeholder="Achternaam *" name="lastName">
                    </div>


                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">E-mail: </label> <br><br>
                        <input placeholder="E-mail" type="email" />
                    </div>

                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Level: </label> <br><br>
                        <input placeholder="Level" type="text" />
                    </div>


                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Geboortedatum: </label> <br><br>
                        <input required type="date" name="birthDate">
                    </div>


                    <div class="inputContainer">
                        <button type="submit">Verzenden</button>
                    </div>

                </form>

            </div>
    </div>

    <?php include "../app/components/bottomNavigation/index.php"; ?>
    <script>
            BotBarNavigation.SwitchActivaty('profiel');
    </script>
</body>
</html>