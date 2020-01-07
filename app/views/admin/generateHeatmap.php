<?php
    if(!$_SESSION['adminLoggedIn']){
        header("Location: /admin/index");
    }

    require_once("header.php");
?>

<html lang="en">
    <head>
        <title>Genereer heatmap - Admin | NL Rangers</title>
    </head>

    <body>
    
        <h1>Welkom op de heatmap-pagina</h1>

        <form method="POST" action="/admin/initHeatmapPeriod">
            <legend>Selecteer een periode om een heatmap te laten genereren:</legend><br>
            <label for="starting_date">Begindatum: </label>
            <input type="date" name="starting_date"><br><br>

            <label for="end_date">Einddatum: </label>
            <input type="date" name="end_date"><br><br>
            
            <input type="submit" name="submit" placeholder="Genereer heatmap">
        </form>
    </body>
</html>