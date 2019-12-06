<?php

class User extends Model
{
    protected $table = 'user';
    protected $fields = [
        'user_id',
        'role_id',
        'first_name',
        'insertion',
        'last_name',
        'birthdate',
        'email_address',
        'password'
    ];

    private function saveUserInDatabase($firstName, $insertion, $lastName, $birthDate, $email_address, $password){
        // THIS FUNCTION SAVES THE USER IN THE DATABASE

        $query = 'INSERT INTO users(role_id, first_name, insertion, last_name, birthdate, email_address, password) VALUES (:firstName, :insertion, :lastName, :birthDate, :email_address, :password)';
        $stmt = $pdo->prepare($query);
        $stmt->
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':insertion', $insertion);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':birthDate', $birthDate);
        $stmt->bindValue(':email_address', $email_address);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
    }

    function __construct()
    {
        
    }

    function checkLogin($email, $password) 
    {
        $db = DB::connect();
        $stmt= $db->prepare("SELECT * FROM `users` WHERE `email_address` = :email");
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
}