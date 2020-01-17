<?php
if (!$_SESSION['adminLoggedIn']) {
    header("Location: /login");
}
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

    <body style="text-align:center">
        <form class="addForm" action="/admin/sendCustomerDataToModel" method="post">
            <label>Bedrijfsnaam: </label><br>
            <input required type="text" class="input" name="company_name"><br>

            <label>Postcode: </label><br>
            <input type="text" name="postal_code" class="input" id="postal_code"><br>

            <label>Straatnaam: </label><br>
            <input type="text" name="street_name" class="input" id="street_name"><br>

            <label>Huisnummer: </label><br>
            <input type="text" name="house_number" class="input" id="house_number"><br>

            <label>Huisletter: </label><br>
            <input type="text" name="house_letter" class="input" id="house_letter"><br>

            <br><div onclick="fillMailingAddress()" id="fillMailingAddress">Het postadres is hetzelfde als het normale adres</div><br><br>

            <label>Postcode factuuradres: </label><br>
            <input type="text" name="mailing_address_postal_code" class="input" id="mailing_address_postal_code"><br>

            <label>Straatnaam postadres: </label><br>
            <input type="text" name="mailing_address_street_name" class="input" id="mailing_address_street_name"><br>

            <label>Huisnummer postadres: </label><br>
            <input type="text" name="mailing_address_house_number" class="input" id="mailing_address_house_number"><br>

            <label>Huisletter postadres: </label><br>
            <input type="text" name="mailing_address_house_letter" class="input" id="mailing_address_house_letter"><br><br>

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