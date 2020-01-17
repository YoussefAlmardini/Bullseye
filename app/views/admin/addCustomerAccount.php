<?php
if (!$_SESSION['adminLoggedIn']) {
    header("Location: /login");
}
?>

<html lang="en">
    <head>
        <title>Klantaccount toevoegen | NL Rangers</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <form action="/registration/catchData" method="post">
            <input type="hidden" name="role_id" value="2">

            <label>Kies de klant waarvoor u een account wil aanmaken: </label>
            <select name="customer">
                <option selected="selected" disabled>Kies een klant</option>
                <?php
                    for($i = 0; $i < count($data['customers']); $i++){
                        echo '<option>' . $data['customers'][$i] . '</option>';
                    }
                ?>
            </select><br><br>

            <label>Voornaam: </label><br>
            <input type="text" name="firstName"><br>

            <label>Tussenvoegsel: </label><br>
            <input type="text" name="insertion"><br>

            <label>Achternaam: </label><br>
            <input type="text" name="lastName"><br>

            <label>Geboortedatum: </label><br>
            <input type="date" name="birthDate"><br>

            <label>E-mailadres</label><br>
            <input type="email" name="email_address"><br>

            <label>Herhaling e-mailadres</label><br>
            <input type="email" name="repeated_email_address"><br>

            <label>Wachtwoord: </label><br>
            <input type="text" name="password"><br>

            <label>Herhaling wachtwoord: </label><br>
            <input type="text" name="repeatedPassword"><br>

            <input type="submit" name="submit">
        </form>
    </body>
</html>