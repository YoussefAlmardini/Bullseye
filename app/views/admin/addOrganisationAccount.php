<?php
if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn']) {
    header("Location: /admin/map");
}
?>

<html lang="en">

<head>
    <title>Organisatieaccount toevoegen | NL Rangers</title>
    <meta charset="UTF-8">
</head>

<body>
    <form action="/registration/catchData" method="post">
        <input type="hidden" name="role_id" value="4">

        <label>Kies de organisatie waarvoor u een account wil aanmaken: </label><br><br>
        <select name="organisation">
            <option selected="selected" disabled>Kies een organisatie</option>
            <?php
            for ($i = 0; $i < count($data['organisations']); $i++) {
                echo '<option>' . $data['organisations'][$i] . '</option>';
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