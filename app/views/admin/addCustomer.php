<?php
if (!$_SESSION['adminLoggedIn']) {
    header("Location: /admin/index");
}

require_once("header.php");
?>

<html lang="en">
    <head>
        <title>Klant toevoegen | NL Rangers</title>
        <meta charset="utf-8">
        <style>
            #fillMailingAddress{
                border: 1px solid black;
                padding: 0.5%;
                display: inline-block;
            }

            #fillMailingAddress:hover{
                cursor: pointer;
                border: 1px solid blue;
                color: blue;
            }
        </style>
    </head>

    <body>
        <form action="/admin/sendCustomerDataToModel" method="post">
            <label>Naam organisatie klant: </label><br>
            <input required type="text" name="company_name"><br>

            <label>Postcode: </label><br>
            <input type="text" name="postal_code" id="postal_code"><br>

            <label>Straatnaam: </label><br>
            <input type="text" name="street_name" id="street_name"><br>

            <label>Huisnummer: </label><br>
            <input type="text" name="house_number" id="house_number"><br>

            <label>Huisletter: </label><br>
            <input type="text" name="house_letter" id="house_letter"><br>

            <br><div onclick="fillMailingAddress()" id="fillMailingAddress">Het postadres is hetzelfde als het normale adres</div><br><br>

            <label>Postcode factuuradres: </label><br>
            <input type="text" name="mailing_address_postal_code" id="mailing_address_postal_code"><br>

            <label>Straatnaam postadres: </label><br>
            <input type="text" name="mailing_address_street_name" id="mailing_address_street_name"><br>

            <label>Huisnummer postadres: </label><br>
            <input type="text" name="mailing_address_house_number" id="mailing_address_house_number"><br>

            <label>Huisletter postadres: </label><br>
            <input type="text" name="mailing_address_house_letter" id="mailing_address_house_letter"><br><br>

            <br><br><input type="submit" name="submit" value="Opslaan">
        </form>

        

        <script>
            function fillMailingAddress(){
                document.getElementById('mailing_address_postal_code').value = document.getElementById('postal_code').value;
                document.getElementById('mailing_address_street_name').value = document.getElementById('street_name').value;
                document.getElementById('mailing_address_house_number').value = document.getElementById('house_number').value;
                document.getElementById('mailing_address_house_letter').value = document.getElementById('house_letter').value;
            }
        </script>
    </body>
</html>