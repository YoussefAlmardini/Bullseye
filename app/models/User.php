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

    function checkLogin($mail, $password) 
    {
        $db = DB::connect();
        $sql = "SELECT * FROM `users` WHERE `email_address` = :email";
        $stmt= $db->prepare($sql);
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }
}