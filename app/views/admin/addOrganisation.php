<?php
if (!$_SESSION['adminLoggedIn'] && !$_SESSION['customerLoggedIn']) {
    header("Location: /login");
}
?>

<html lang="en">
    <head>
        <title>Organisatie toevoegen | NL Rangers</title>
        <link rel="stylesheet" type="text/css" href="../src/styles/admin_organisation.css">
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
        <div id="sideNav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="/admin/map">Speurtocht aanmaken</a>
            <a href="/admin/profiel">Uw profiel</a>
            <a href="/admin/registeradmin">Profiel aanmaken</a>
            <a href="/admin/addCustomer">Klant aanmaken</a>
            <a href="/admin/addContact">Contact aanmaken</a>
            <a href="/admin/generateHeatmap">Heatmap</a>
            <form method="POST">
                <a><input id="uitlog" type="submit" value="Uitloggen" name="logout"></a>
            </form>

        </div>
        <span  id="navOpenButton" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>


        <form action="/admin/sendOrganisationDataToModel" method="post">
            <input type="hidden" name="customer_id" value="<?php echo $data['customer_id'] ?>">

            <label>Naam organisatie: </label><br>
            <input required type="text" name="organisation_name"><br>

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

            function openNav() {
                document.getElementById("sideNav").style.width = "250px";
                document.getElementById("navOpenButton").style.zIndex = "0";
            }

            function closeNav() {
                document.getElementById("sideNav").style.width = "0";
                document.getElementById("navOpenButton").style.zIndex = "1";
            }


            function fillMailingAddress(){
                document.getElementById('mailing_address_postal_code').value = document.getElementById('postal_code').value;
                document.getElementById('mailing_address_street_name').value = document.getElementById('street_name').value;
                document.getElementById('mailing_address_house_number').value = document.getElementById('house_number').value;
                document.getElementById('mailing_address_house_letter').value = document.getElementById('house_letter').value;
            }
        </script>
    </body>
</html>