<html>

<head>
    <link rel="stylesheet" type="text/css" href="../src/styles/generalStyles.css">
    <link rel="stylesheet" type="text/css" href="../src/styles/registreren.css">
    <script src="/src/js/mobility.js"></script>
</head>

<body>
    <div class="viewContainer viewContainerCustom">

        <div class="topBlock">

            <div class="Title">
                NLRANGERS
            </div>

            <div class="notification">

            </div>

        </div>

        <div class="middleBlock">
            <div class="secondTitle formTitle">
                Registreren
            </div>

            <form class="formregister" action="/registration/catchData" method="POST">
                <input type="hidden" name="role_id" value="1">

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
                    <input required type="email" name="repeated_email_address" placeholder="Herhaal e-mailadres *">
                </div>

                <div class="inputContainer">
                    <input required type="password" placeholder="Wachtwoord *" id="password" name="password">
                    <img class="passwordshow" id="passwordshowimage" src="../src/assets/Icon-eye.png" onclick="showPassword()">
                </div>

                <div class="inputContainer">
                    <input required type="password" name="repeatedPassword" id="passwordrepeat" placeholder="Herhaal wachtwoord *">
                    <img class="passwordshow3" id="passwordshowimage2" src="../src/assets/Icon-eye.png" onclick="showPassword2()">
                </div>

                <div class="inputContainer">
                    <button required name="submit" onclick="changePasswordType(); changePasswordType2()" type="submit">Verzenden</button>
                </div>

            </form>

        </div>

        <div class="bottomBlock">

            <div class="secondTitle">Heeft u al een account?</div>
            <div class="link"><a href="/login/index"">Inloggen</a></div>

    </div>


</div>


</body>
</html>
<script>
    function showPassword() {
        var x = document.getElementById(" password"); var img=document.getElementById("passwordshowimage"); if (x.type==="password" ) { x.type="text" ; img.src="../src/assets/Icon-eye-off.png" ; img.className="passwordshow2" ; } else { x.type="password" ; img.src="../src/assets/Icon-eye.png" ; img.className="passwordshow" ; } } function changePasswordType() { var x=document.getElementById("password"); var img=document.getElementById("passwordshowimage"); if (x.type==="password" ) { } else { x.type="password" ; img.src="../src/assets/Icon-eye.png" ; img.className="passwordshow" ; } } function showPassword2() { var x=document.getElementById("passwordrepeat"); var img=document.getElementById("passwordshowimage2"); if (x.type==="password" ) { x.type="text" ; img.src="../src/assets/Icon-eye-off.png" ; img.className="passwordshow4" ; } else { x.type="password" ; img.src="../src/assets/Icon-eye.png" ; img.className="passwordshow3" ; } } function changePasswordType2() { var x=document.getElementById("passwordrepeat"); var img=document.getElementById("passwordshowimage2"); if (x.type==="password" ) { } else { x.type="password" ; img.src="../src/assets/Icon-eye.png" ; img.className="passwordshow3" ; } } </script>