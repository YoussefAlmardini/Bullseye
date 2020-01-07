<?php
     include "app/views/header/index.php";
?>
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
                        <label class="birthdatetitle" for="birthDate">Voornaam: </label>
                        <input required type="text" placeholder="Voornaam *" id="inputs" readonly name="firstName">
                        <img class="iconInputProfiel" id="icon-voornaam" onclick="Edit(this)" src="../src/assets/Icon-edit.png">
                    </div>

                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Tussenvoegsel: </label>
                        <input type="text" placeholder="Tussenvoegsel" id="inputs" readonly name="insertion">
                        <img class="iconInputProfiel2" onclick="Edit(this)" src="../src/assets/Icon-edit.png">
                    </div>

                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Achternaam: </label>
                        <input required type="text" placeholder="Achternaam *" id="inputs" readonly name="lastName">
                        <img class="iconInputProfiel3" onclick="Edit(this)" src="../src/assets/Icon-edit.png">

                    </div>


                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">E-mail: </label>
                        <input required type="email" placeholder="E-mail *" id="inputs" readonly name="email">
                        <img class="iconInputProfiel4" onclick="Edit(this)" src="../src/assets/Icon-edit.png">
                    </div>

                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Level: </label>
                        <input required type="text" placeholder="Level *" id="inputs" readonly name="level">
                        <img class="iconInputProfiel5" onclick="Edit(this)" src="../src/assets/Icon-edit.png">
                    </div>


                    <div class="inputContainer">
                        <label class="birthdatetitle" for="birthDate">Geboortedatum: </label>
                        <input required type="date" id="inputs" readonly name="birthdate">
                        <img class="iconInputProfiel6" onclick="Edit(this)" src="../src/assets/Icon-edit.png">
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