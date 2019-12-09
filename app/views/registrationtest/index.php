<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registreren - NL Rangers</title>
    <link rel="stylesheet" href="registration.css">
</head>

<body>
    <form action="/registration/catchData" method="POST">
        <input required type="text" placeholder="Voornaam *" name="firstName"> <br><br>
        <input type="text" placeholder="Tussenvoegsel" name="insertion"> <br><br>
        <input required type="text" placeholder="Achternaam *" name="lastName"> <br><br>
        <label for="birthDate">Geboortedatum: </label>
        <input required type="date" name="birthDate"> <br><br>
        <input required type="email" placeholder="E-mailadres *" name="email_address"> <br><br>
        <input required type="email" placeholder="Herhaal e-mailadres *"> <br><br>
        <input required type="password" placeholder="Wachtwoord *" name="password"> <br><br>
        <input required type="password" placeholder="Herhaal wachtwoord *"> <br><br>
        <input required type="submit" placeholder="Registreren" name="submit">
    </form>
</body>

</html>