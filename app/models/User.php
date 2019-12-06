<?php

class User extends Model
{
    protected $table = 'user';
    protected $fields = [
        'id',
        'role_id',
        'email',
        'password',
        'birthdate',
        'first_name',
        'insertion',
        'last_name'
    ];

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