<?php
if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn'] && !$_SESSION['organisationLoggedIn']) {
    header("Location: /login");
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Account bijwerken | NL Rangers</title>
    </head>

    <body>
        <form action="/admin/sendProfileDataToModel">
            <label>Voornaam: </label><br>
            <input type="text" name="firstName" value="<?php $data['profileData']['first_name'] ?>"><br>

            <label>Tussenvoegsel: </label><br>
            <input type="text" name="insertion" value="<?php $data['insertion'] ?>"><br>

            <label>Achternaam: </label><br>
            <input type="text" name="lastName" value="<?php $data['last_name'] ?>"><br>

            <label>E-mailadres: </label><br>
            <input type="email" name="email" value="<?php $data['email_address'] ?>"><br><br>

            <input type="submit" name="submit">
        </form>
    </body>
    
    <!-- <?php var_dump($data['profileData']); ?> -->
</html>