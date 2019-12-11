<?php
if(!$_SESSION['adminLoggedIn']){
    header("Location: /admin/index");
}

require_once("header.php");
?>

<html lang="en">

<head>
    <title>Dashboard - Admin | NL Rangers</title>
    <meta charset="UTF-8">
</head>

<body>
    <div>Welkom op de dashboard-pagina!</div>
</body>

</html>