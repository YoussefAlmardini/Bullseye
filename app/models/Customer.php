<?php

class Customer extends Model
{
    public function saveCustomer($companyName, $postalCode, $streetName, $houseNumber, $houseLetter, $mailingAddressPostalCode, $mailingAddressStreetName, $mailingAddressHouseNumber, $mailingAddressHouseLetter)
    {
        try {
            $queryInsertCustomer = 'INSERT INTO customers (name) VALUES (:name);';
            $db = DB::connect();
            $stmt = $db->prepare($queryInsertCustomer);
            $stmt->bindValue(':name', $companyName);
            $stmt->execute();

            $queryGetCustomer = 'SELECT customer_id FROM customers WHERE name = (:name);';
            $db = DB::connect();
            $stmt = $db->prepare($queryGetCustomer);
            $stmt->bindValue(':name', $companyName);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            $customerID = $row->customer_id;

            $queryInsertCustomerNAD = 'INSERT INTO nad (content_type, customer_id, postal_code, street_name, house_number, house_letter, mailing_address_postal_code, mailing_address_street_name, mailing_address_house_number, mailing_address_house_letter) VALUES (:content_type, :customer_id, :postal_code, :street_name, :house_number, :house_letter, :mailing_address_postal_code, :mailing_address_street_name, :mailing_address_house_number, :mailing_address_house_letter);';
            $db = DB::connect();
            $stmt = $db->prepare($queryInsertCustomerNAD);
            $stmt->bindValue(':content_type', 'customer');
            $stmt->bindValue('customer_id', $customerID);
            $stmt->bindValue('postal_code', $postalCode);
            $stmt->bindValue('street_name', $streetName);
            $stmt->bindValue('house_number', $houseNumber);
            $stmt->bindValue('house_letter', $houseLetter);
            $stmt->bindValue('mailing_address_postal_code', $mailingAddressPostalCode);
            $stmt->bindValue('mailing_address_street_name', $mailingAddressStreetName);
            $stmt->bindValue('mailing_address_house_number', $mailingAddressHouseNumber);
            $stmt->bindValue('mailing_address_house_letter', $mailingAddressHouseLetter);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
