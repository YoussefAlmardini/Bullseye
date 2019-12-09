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
        $stmt = $db->prepare("SELECT * FROM `users` WHERE `email_address` = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If email is not valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
           // E-mail is valid!
        } else {
            $_SESSION['errors'] = '';
            $_SESSION['errors']['unvalid_email'] = true;
        }

        //If user does not exist
        if($user === false){
            $_SESSION['errors'] = '';
            $_SESSION['errors']['inc_username'] = true;
            return false;
        } else{
            $validPassword = password_verify($password, $user['password']);
            if($validPassword){
                $_SESSION['user'] = $user;
                $_SESSION['logged_in'] = time();
                $_SESSION['errors'] = '';
                //TODO: Link naar alle speurtochten
                return true;    
            } else{
                $_SESSION['errors'] = '';
                $_SESSION['errors']['inc_password'] = true;
                return false;
            }
        }
    }
}