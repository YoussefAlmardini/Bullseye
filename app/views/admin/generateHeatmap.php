<?php
if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn'] && !$_SESSION['organisationLoggedIn']) {
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

            <label>Selecteer een organisatie: </label><br>

            <select>
                <option selected="selected" disabled="disabled" name="organisation">Kies een organisatie</option>
                <?php
                    for($i = 0; $i < count($data['organisations']); $i++){
                        echo '<option value=" '. $data['organisations']['organisation_id'] .' ">' . $data['organisations']['organisation'][$i] . '</option>';
                    }
                ?>
            </select>

            <label for="starting_date">Begindatum: </label>
            <input type="date" name="starting_date"><br><br>

            <label for="end_date">Einddatum: </label>
            <input type="date" name="end_date"><br><br>
            
            <input type="submit" name="submit" value="Genereer heatmap">
        </form>
    </body>
</html>