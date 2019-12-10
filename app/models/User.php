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

    public function validateUserInput($firstName, $insertion, $lastName, $birthDate, $email_address, $repeatedEmail_address, $password, $repeatedPassword, $hashedPassword){
        // THIS FUNCTION VALIDATES THE BY THE USER INSERTED DATA

        if(
            filter_var($email_address, FILTER_VALIDATE_EMAIL) &&
            $email_address === $repeatedEmail_address
        ){
            if(User::checkForExistance($email_address)){
                if($password === $repeatedPassword){
                    if(strtotime($birthDate) - time() < 0){
                        User::saveUserInDatabase($firstName, $insertion, $lastName, $birthDate, $email_address, $hashedPassword);
                        return true;
                    }else{
                        echo "<script>alert('Uw geboortedatum kan zich niet in de toekomst bevinden!');</script>";
                    }
                }else{
                    echo "<script>alert('De wachtwoorden in beide velden moeten overeenkomen!');</script>";
                }
            }else{
                echo "<script>alert('Er bestaat al een gebruiker met hetzelfde e-mailadres!');</script>";
            }
        }else{
            echo "<script>alert('De e-mailadressen in beide velden moeten overeenkomen!');</script>";
        }
    }

    public function checkForExistance($email_address){
        // THIS FUNCTION CHECKS FOR EXISTANCE OF THE BY THE USER INSERTED E-MAILADDRESS

        $query = 'SELECT user_id FROM users WHERE email_address = :email_address';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email_address', $email_address);
        $stmt->execute();
        
        if($stmt->rowCount() < 1){
            return true;
        }else{
            return false;
        }
    }

    public function saveUserInDatabase($firstName, $insertion, $lastName, $birthDate, $email_address, $password){
        // THIS FUNCTION SAVES THE USER IN THE DATABASE
        
        $query = 'INSERT INTO users(role_id, first_name, insertion, last_name, birthdate, email_address, password) VALUES (:role_id, :firstName, :insertion, :lastName, :birthDate, :email_address, :password);';
        $db = DB::connect();
        $stmt = $db->prepare($query);
        $stmt->bindValue(':role_id', "1");
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':insertion', $insertion);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':birthDate', (new Datetime($birthDate))->format('Y-m-d'));
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