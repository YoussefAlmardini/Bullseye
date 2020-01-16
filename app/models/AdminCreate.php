<?php

class AdminCreate extends Model
{
    public function CreateAdmin($role_id, $firstname, $insertion, $lastname, $birthdate, $emailaddress, $password){

        $db = DB::connect();

        $queryInsertAdmin = 'INSERT INTO users (role_id, first_name, insertion, last_name, birthdate, email_address, password) VALUES (:role, :fname, :insertion, :lname, :bdate, :email, :pword) ';
        $stmt = $db->prepare($queryInsertAdmin);
        $stmt->bindValue(':role', $role_id);
        $stmt->bindValue(':fname', $firstname);
        $stmt->bindValue(':insertion', $insertion);
        $stmt->bindValue(':lname', $lastname);
        $stmt->bindValue(':bdate', $birthdate);
        $stmt->bindValue(':email', $emailaddress);
        $stmt->bindValue(':pword', $password);
        $stmt->execute();

    }
}