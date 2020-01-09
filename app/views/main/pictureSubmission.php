<?php

?>

<html lang="en">
    <head>
        <title>Zend uw foto in</title>
    </head>

    <body>
        <form action="/pictureSubmission/sendDataToModel" method="post">
            <label for="picture">Verstuur hier uw foto die u genomen heeft tijdens of na de speurtocht.</label><br><br>
            <input required type="file" name="picture"><br><br>
            <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" name="user_id">
            <input type="submit" value="Verstuur foto">
        </form>
    </body>
</html>