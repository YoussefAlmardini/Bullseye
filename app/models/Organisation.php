<?php

class Organisation extends Model
{
    public function saveOrganisation($customer, $organisationName, $postalCode, $streetName, $houseNumber, $houseLetter, $mailingAddressPostalCode, $mailingAddressStreetName, $mailingAddressHouseNumber, $mailingAddressHouseLetter){
        $db = DB::connect();

        $queryGetCustomer = 'SELECT customer_id FROM customers WHERE name = :name;';
        $stmt = $db->prepare($queryGetCustomer);
        $stmt->bindValue(':name', $customer);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $customerID = $row->customer_id;
        
        $queryInsertOrganisation = 'INSERT INTO organisations (name, customer_id) VALUES (:name, :customerID);';
        $stmt = $db->prepare($queryInsertOrganisation);
        $stmt->bindValue(':name', $organisationName);
        $stmt->bindValue(':customerID', $customerID);
        $stmt->execute();

        $queryGetOrganisation = 'SELECT organisation_id FROM organisations WHERE name = :name AND customer_id = :customer_id;';
        $stmt = $db->prepare($queryGetOrganisation);
        $stmt->bindValue(':name', $organisationName);
        $stmt->bindValue(':customer_id', $customerID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $organisationID = $row->organisation_id;

        $queryInsertOrganisationNAD = 'INSERT INTO nad (content_type, organisation_id, postal_code, street_name, house_number, house_letter, mailing_address_postal_code, mailing_address_street_name, mailing_address_house_number, mailing_address_house_letter) VALUES (:content_type, :organisation_id, :postal_code, :street_name, :house_number, :house_letter, :mailing_address_postal_code, :mailing_address_street_name, :mailing_address_house_number, :mailing_address_house_letter);';
        $stmt = $db->prepare($queryInsertOrganisationNAD);
        $stmt->bindValue(':content_type', 'organisation');
        $stmt->bindValue(':organisation_id', $organisationID);
        $stmt->bindValue(':postal_code', $postalCode);
        $stmt->bindValue(':street_name', $streetName);
        $stmt->bindValue(':house_number', $houseNumber);
        $stmt->bindValue(':house_letter', $houseLetter);
        $stmt->bindValue(':mailing_address_postal_code', $mailingAddressPostalCode);
        $stmt->bindValue(':mailing_address_street_name', $mailingAddressStreetName);
        $stmt->bindValue(':mailing_address_house_number', $mailingAddressHouseNumber);
        $stmt->bindValue(':mailing_address_house_letter', $mailingAddressHouseLetter);
        $stmt->execute();
    }
}