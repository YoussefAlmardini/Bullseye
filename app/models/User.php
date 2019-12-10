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
        $db = DB::connect();
        $query = 'INSERT INTO users(role_id, first_name, insertion, last_name, birthdate, email_address, password) VALUES (:firstName, :insertion, :lastName, :birthDate, :email_address, :password)';
        $stmt = $db->prepare($query);
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
        if($db == false) {$_SESSION['errors']['no_connection'] = true;}
        $stmt = $db->prepare("SELECT * FROM `users` WHERE `email_address` = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['errors'] = [];
        // If email is not valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
           unset($_SESSION['errors']);
        } else {
            unset($_SESSION['errors']);
            $_SESSION['errors']['unvalid_email'] = true;
            return false;
        }

        //If user does not exist
        if($user === false){
            unset($_SESSION['errors']);
            $_SESSION['errors']['inc_username'] = true;
            return false;
        } else{
            $validPassword = password_verify($password, $user['password']);
            if($validPassword){
                $_SESSION['user'] = $user;
                $_SESSION['logged_in'] = time();
                unset($_SESSION['errors']);
                return true;    
            } else{
                unset($_SESSION['errors']);
                $_SESSION['errors']['inc_password'] = true;
                return false;
            }
        }
    }
}