<?php
if (!$_SESSION['adminLoggedIn']) {
    header("Location: /admin/index");
}

require_once("header.php");
?>

<html lang="en">
<head>
    <title>Contact toevoegen | NL Rangers</title>
    <meta charset="utf-8">
</head>

<body>
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
</html>