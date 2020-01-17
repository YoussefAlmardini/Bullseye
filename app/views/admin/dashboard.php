<?php
if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn'] && !$_SESSION['organisationLoggedIn']) {
    header("Location: /login");
}
?>

<html lang="en">

<head>
    <title>Dashboard - Admin | NL Rangers</title>
    <meta charset="UTF-8">
</head>

<body>
    <div>Welkom op de dashboard-pagina!</div>

    <a href="/admin/addCustomer">Organisatie toevoegen</a>
</body>

</html>