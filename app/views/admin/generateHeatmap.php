<?php
if (!$_SESSION['organisationLoggedIn']) {
    header("Location: /login");
}
?>

<html lang="en">
    <head>
        <title>Genereer heatmap - Admin | NL Rangers</title>
    </head>

    <body>
    
        <h1>Welkom op de heatmap-pagina</h1>

        <form method="POST" action="/admin/initHeatmapPeriod">
            <legend>Selecteer informatie om een heatmap te laten genereren:</legend><br>
            <input type="hidden" name="organisation_id" value="<?php echo $_SESSION['organisation_id'] ?>">

            <label for="starting_date">Begindatum: </label>
            <input type="date" name="starting_date"><br><br>

            <label for="end_date">Einddatum: </label>
            <input type="date" name="end_date"><br><br>
            
            <input type="submit" name="submit" value="Genereer heatmap">
        </form>
    </body>
</html>