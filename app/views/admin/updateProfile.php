<?php
if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn'] && !$_SESSION['organisationLoggedIn']) {
    header("Location: /admin/map");
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Account bijwerken | NL Rangers</title>
    </head>

    <body>
        <form action="/admin/sendProfileDataToModel" method="post">
            <label>Voornaam: </label><br>
            <input type="text" name="firstName" value="<?php echo $data['profileData'][0][0] ?>"><br>

            <label>Tussenvoegsel: </label><br>
            <input type="text" name="insertion" value="<?php echo $data['profileData'][0][1] ?>"><br>

            <label>Achternaam: </label><br>
            <input type="text" name="lastName" value="<?php echo $data['profileData'][0][2] ?>"><br>

            <label>E-mailadres: </label><br>
            <input type="email" name="email" value="<?php echo $data['profileData'][0][3] ?>"><br><br>

            <input type="submit" name="submit">
        </form>
    </body>
</html>