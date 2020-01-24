<?php

class Contact extends Model
{
    public function saveContact($customer, $firstname, $insertion, $lastname, $function, $email, $phonenumber)
    {
        try {
            $db = DB::connect();

            $queryGetCustomer = 'SELECT customer_id FROM customers WHERE name = :name;';
            $stmt = $db->prepare($queryGetCustomer);
            $stmt->bindValue(':name', $customer);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            $customerID = $row->customer_id;

            $queryInsertContactData = 'INSERT INTO contact_data (first_name, insertion, last_name, function,email_address, phone_number) VALUES (:fname, :insertion, :lname, :function, :email, :phonenumber);';
            $stmt = $db->prepare($queryInsertContactData);
            $stmt->bindValue(':fname', $firstname);
            $stmt->bindValue(':insertion', $insertion);
            $stmt->bindValue(':lname', $lastname);
            $stmt->bindValue(':function', $function);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':phonenumber', $phonenumber);
            $stmt->execute();

            $queryGetDataID = 'SELECT data_id FROM contact_data WHERE email_address = :email;';
            $stmt = $db->prepare($queryGetDataID);
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            $data_id = $row->data_id;

            $queryInsertOrganisation = 'INSERT INTO customers_customer_data (data_id, customer_id) VALUES (:dataID, :customerID);';
            $stmt = $db->prepare($queryInsertOrganisation);
            $stmt->bindValue(':dataID', $data_id);
            $stmt->bindValue(':customerID', $customerID);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
